<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProductController extends Controller
{
    public static function makeProductArray() {
        $file= '../public/products.json'; 
        $string = file_get_contents($file);

        $productsJson = json_decode($string, true);

        $products = [];
        $books = [];
        $cds = [];
        foreach ($productsJson as $product) {
            switch($product['type']) {
                case "cd":
                    $cdproduct = new CdProduct($product['id'],$product['title'],  $product['firstname'],
                        $product['mainname'],$product['price'], $product['playlength']);
                    $cds[] = $cdproduct;
                    break;
                case "book":
                    $bookproduct = new BookProduct($product['id'],$product['title'],  $product['firstname'],
                        $product['mainname'],$product['price'], $product['numpages']);
                    $books[]=$bookproduct;
                    break;
            }
        }
        // return $products;
        return view('products',['cds'=>$cds, 'books'=>$books]);
    }

    public static function deleteProductWithId(int $id) {
        $file= '../public/products.json'; 
        $string = file_get_contents($file);

        $productsJson = json_decode($string, true);

        $products = [];
        foreach ($productsJson as $product) {
            if($product['id'] != $id) {
                $products[] = $product;
            }
        }
        $json = json_encode($products);
        if(file_put_contents($file, $json))
            return redirect('/products');
        else
            return false;
    }

    public static function getProductWithId(int $id) {
        $file = '../public/products.json';
        $string = file_get_contents($file);

        $productsJson = json_decode($string, true);

        $products = [];
        foreach ($productsJson as $product) {
            if($product['id']==$id) {
                switch ($product['type']) {
                    case "cd":
                        $cdproduct = new CdProduct($product['id'], $product['title'],  $product['firstname'],
                            $product['mainname'], $product['price'], $product['playlength']);
                        $products[] = $cdproduct;
                        return view('singleCd',['id'=>$products]);
                        break;
                    case "book":
                        $bookproduct = new BookProduct($product['id'], $product['title'],  $product['firstname'],
                            $product['mainname'], $product['price'], $product['numpages']);
                        $products[] = $bookproduct;
                        return view('singleBook',['id'=>$products]);
                        break;
                }
                break;
            }
        }
        return $products;
    }

    public static function addNewProduct()
    {
        $file= '../public/products.json'; 
        $string = file_get_contents($file);

        $productsJson = json_decode($string, true);

        $ids = [];
        foreach ($productsJson as $product) {
             $ids[] = $product['id'];
        }
        rsort($ids);
        $newId = $ids[0] + 1;

        $products = [];
        foreach ($productsJson as $product) {
            $products[] = $product;
        }

        $newProduct = [];
        $newProduct['id'] = $newId;
        $newProduct['type'] = request('type');
        $producttype = request('type');
        $newProduct['title'] = request('title');
        $newProduct['firstname'] = request('firstname');
        $newProduct['mainname'] = request('surname');
        $newProduct['price'] = request('price');

        if($producttype=='cd') $newProduct['playlength'] = request('papl');
        if($producttype=='book') $newProduct['numpages'] = request('papl');

        $products[] = $newProduct;

        $json = json_encode($products);
        if(file_put_contents($file, $json))
            return redirect('/products');
        else
            return 'Data Insertion Failed';
    }

    public static function updateProductWithId(int $id)
    {
        $file= '../public/products.json'; 
        $string = file_get_contents($file);
        $products= [];
        $productsJson = json_decode($string, true);

        foreach ($productsJson as $product) {
            if($product['id']==$id) {
                $product['title'] = request('title');
                $product['firstname'] = request('firstname');
                $product['mainname'] = request('surname');
                $product['price'] = request('price');
                if($product['type']=='cd') $product['playlength'] = request('papl');
                if($product['type']=='book') $product['numpages'] = request('papl');
            }
            $products[] = $product;
        }

        $json = json_encode($products);
        if(file_put_contents($file, $json))
            return redirect('/products');
        else
            return false;
    }
}

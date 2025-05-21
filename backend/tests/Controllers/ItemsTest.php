<?php

namespace Tests\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\ItemModel;

class ItemsTest extends CIUnitTestCase
{
    use ControllerTestTrait, DatabaseTestTrait;
    
    protected $seed = 'App\Database\Seeds\ItemSeeder';
    protected $basePath = 'backend/app/Database/';
    
    public function testIndex()
    {
        $result = $this->withHeaders([
                'Authorization' => '******',
            ])
            ->controller('App\Controllers\Items')
            ->execute('index');
            
        $result->assertStatus(200);
        $result->assertJSONFragment(['status' => 'success']);
        
        $items = json_decode($result->getJSON(), true);
        $this->assertArrayHasKey('data', $items);
        $this->assertIsArray($items['data']);
    }
    
    public function testShow()
    {
        $model = new ItemModel();
        $item = $model->first();
        
        $result = $this->withHeaders([
                'Authorization' => '******',
            ])
            ->controller('App\Controllers\Items')
            ->execute('show', $item['id']);
            
        $result->assertStatus(200);
        $result->assertJSONFragment(['status' => 'success']);
        
        $response = json_decode($result->getJSON(), true);
        $this->assertArrayHasKey('data', $response);
        $this->assertEquals($item['id'], $response['data']['id']);
    }
    
    public function testCreate()
    {
        $itemData = [
            'name' => 'Test Item',
            'description' => 'This is a test item',
            'price' => 49.99,
            'status' => 'active',
        ];
        
        $result = $this->withHeaders([
                'Authorization' => '******',
                'Content-Type' => 'application/json',
            ])
            ->controller('App\Controllers\Items')
            ->execute('create');
            
        $result->assertStatus(201);
        $result->assertJSONFragment(['status' => 'success']);
        $result->assertJSONFragment(['message' => 'Item created successfully']);
        
        $response = json_decode($result->getJSON(), true);
        $this->assertArrayHasKey('data', $response);
        $this->assertEquals($itemData['name'], $response['data']['name']);
    }
    
    public function testUpdate()
    {
        $model = new ItemModel();
        $item = $model->first();
        
        $updateData = [
            'name' => 'Updated Item',
            'price' => 59.99,
        ];
        
        $result = $this->withHeaders([
                'Authorization' => '******',
                'Content-Type' => 'application/json',
            ])
            ->controller('App\Controllers\Items')
            ->execute('update', $item['id']);
            
        $result->assertStatus(200);
        $result->assertJSONFragment(['status' => 'success']);
        $result->assertJSONFragment(['message' => 'Item updated successfully']);
        
        $response = json_decode($result->getJSON(), true);
        $this->assertArrayHasKey('data', $response);
        $this->assertEquals($updateData['name'], $response['data']['name']);
        $this->assertEquals($updateData['price'], $response['data']['price']);
    }
    
    public function testDelete()
    {
        $model = new ItemModel();
        $item = $model->first();
        
        $result = $this->withHeaders([
                'Authorization' => '******',
            ])
            ->controller('App\Controllers\Items')
            ->execute('delete', $item['id']);
            
        $result->assertStatus(200);
        $result->assertJSONFragment(['status' => 'success']);
        $result->assertJSONFragment(['message' => 'Item deleted successfully']);
        
        $this->assertNull($model->find($item['id']));
    }
}
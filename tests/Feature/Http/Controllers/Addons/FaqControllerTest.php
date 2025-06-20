<?php

namespace Tests\Feature\Http\Controllers\Addons;

use App\Models\Addons\Faq;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\TestCase;

class FaqControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // Note:: To test replace require_once with require in web.php
    
    /** @test */
    public function faq_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('faq.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.faq.create');
    }

    /** @test */
    public function faq_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->post(route('faq.store'), [
            'uuid'  => Str::uuid(),
            'question' => 'This is testing question',
            'answer' => 'This is just for testing purpose.',
            'user_id' => $user->id,
        ]);
        $response->assertRedirect('/faq');
    }

    /** @test */
    public function faq_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $faq = Faq::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('faq.edit', $faq->uuid));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.faq.edit');
    }

    /** @test */
    public function faq_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $faq = Faq::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('faq.update', [$faq->uuid]), [
            'question' => 'This is a testing question',
            'answer' => $faq->answer,
        ]);
        $response->assertRedirect('/faq');
        $this->assertDatabaseHas('faqs', [
            'question' => 'This is a testing question',
        ]);
    }

    /** @test */
    public function faq_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $faq = Faq::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('faq.change.status', [$faq->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function faq_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $faq = Faq::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('faq.destroy', [$faq->uuid]));
        $response->assertStatus(302);
    }
    /** @test */
    public function faq_manage_order()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $db_faqs = Faq::pluck('id')->toArray();
        $count = count($db_faqs);
        for($i=0; $i<$count; $i++)
        {
            $faq[$i] = $value = Arr::random($db_faqs);
            unset($db_faqs[array_search($value, $db_faqs)]);
        }
        $response = $this->actingAs($user)->post(route('faq.manage.order'), [
            'faq' => $faq
        ]);
        $response->assertStatus(200);
    }
}

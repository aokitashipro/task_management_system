<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Category;
use App\Member;
use App\User;

use App\Http\Requests;

class SettingsController extends Controller
{
    //

    public function __construct()
      {
          $this->middleware('auth');
      }


      public function index()
      {

        $customers = Customer::all();
        $categories = Category::all();
        $members = Member::all();

         return view('tasks.setting',compact('categories'))
         ->with('customers', $customers)
         ->with('categories',$categories)
         ->with('members',$members);
        }

        public function setting_customer_create()
        {

          return view('tasks.setting_customer_create');
        }

      public function setting_category_create()
      {

        return view('tasks.setting_category_create', compact('categories'));
      }

      public function setting_member_create()
      {

         return view('tasks.setting_member_create', compact('members'));
      }


      public function setting_customer_update($id)
      {
        $customers = Customer::findorFail($id);

         return view('tasks.setting_customer_update', compact('customers'));
      }

      public function setting_category_update($id)
      {
        $categories = Category::findorFail($id);

         return view('tasks.setting_category_update', compact('categories'));
      }

      public function setting_member_update($id)
      {
        $members = Member::findorFail($id);

         return view('tasks.setting_member_update', compact('members'));
      }

      public function setting_customer_changed(Request $request, $id)
      {
        $customers = Customer::findorFail($id);
        $customers->customer_name = $request->customer_name;
        $customers->visible_flag = $request->visible_flag;
        $customers->save();

        return redirect()->to('/tasks/setting');
      }

      public function setting_category_changed(Request $request, $id)
      {
        $categories = Category::findorFail($id);
        $categories->category_name = $request->category_name;
        $categories->visible_flag = $request->visible_flag;
        $categories->save();

        return redirect()->to('/tasks/setting');
      }

      public function setting_member_changed(Request $request, $id)
      {
        $members = Member::findorFail($id);
        $members->member_name = $request->member_name;
        $members->visible_flag = $request->visible_flag;
        $members->save();

        return redirect()->to('/tasks/setting');
      }

      public function setting_customer_store(Request $request)
      {

        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->visible_flag = 1;
        $customer->save();

        $customer->customer_id = $customer->id;
        $customer->save();

        return redirect()->to('/tasks/setting');
      }

      public function setting_category_store(Request $request)
      {

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->visible_flag = 1;
        $category->save();

        $category->category_id = $category->id;
        $category->save();

        return redirect()->to('/tasks/setting');
      }


      public function setting_member_store(Request $request)
      {

        $member = new Member();
        $member->member_name = $request->member_name;
        $member->visible_flag = 1;
        $member->save();

        $member->member_id = $member->id;
        $member->save();

        return redirect()->to('/tasks/setting');
      }



}

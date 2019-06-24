<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Category;
use App\Customer;
use App\Stock;
use App\User;
use App\Service;
use App\AddService;
use App\Color;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function category()
    {
        $data = Category::all();
        return view('cloth.category', compact('data'));
    }

    public function addcategory()
    {
        return view('cloth.addcategory');
    }

    public function entercategory(Request $request)
    {
        $request->validate([
            'category' => 'required|unique:Categories',
            'amount' => 'required',
            'qty' => 'required',
        ]);
        Category::create([
            'category' => $request['category'],
            'amount' => $request['amount'],
            'qty' => $request['qty'],
        ]);
        Session::flash('success', 'category entered successfully');
        return redirect('category');
    }

    public function editcategory($id)
    {
        $data = Category::where('id', $id)->get();
        return view('cloth.editcategory', compact('data'));
    }

    public function categoryedit(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'amount' => 'required',
            'qty' => 'required',
        ]);
        Category::where('id', $request['id'])
        ->update([
            'category' => $request['category'],
            'amount' => $request['amount'],
            'qty' => $request['qty'],
        ]);
        Session::flash('success', 'category updated successfully');
        return redirect('category');
    }

    public function deletecategory($id)
    {
        Category::where('id', $id)->delete();
        Session::flash('error', 'category deleted successfully');
        return redirect('category');
    }

    public function customer()
    {
        $data = Customer::orderBy('id', 'desc')->get();
        return view('cloth.customer', compact('data'));
    }

    public function addcustomer()
    {
        return view('cloth.addcustomer');
    }

    public function entercustomer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);
        $random = substr(md5(mt_rand()), 0, 7);
        Customer::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'cus_id' => $random,
        ]);
        Session::flash('success', 'Customer created successfully');
        return redirect('customer');
    }

    public function customeredit($id)
    {
        $data = Customer::where('id', $id)->get();
        return view('cloth.customeredit', compact('data'));
    }

    public function updatecustomer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);
        Customer::where('cus_id', $request['cus_id'])
        ->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'address' => $request['address'],
            'phone' => $request['phone'],
        ]);
        Session::flash('success', 'Customer updated successfully');
        return redirect('customer');
    }

    public function customerdelete($id)
    {
        Customer::where('id', $id)->delete();
        Session::flash('error', 'Customer deleted successfully');
        return redirect('customer');
    }

    public function stock()
    {
        $data = Stock::select('tag')->distinct()->get();
        //dd($data);
        return view('cloth.stock', compact('data'));
    }

    public function addstock()
    {
        $data = Customer::all();
        return view('cloth.addstock', compact('data'));
    }

    public function searchcustomer(Request $request)
    {
        $request->validate([
            'customer' => 'required'
        ]);
        $data = Customer::where('cus_id', $request['customer'])->get();
        if ($data->isEmpty()) {
            Session::flash('error', 'no record found');
            return redirect('addstock');
        }
        Session::put('code', $request['customer']);
        return redirect('enterstock');
    }

    public function enterstock()
    {
        $code = Session::get('code');
        //$data = Customer::where('cus_id', $code)->get();
        $data = Category::all();
        return view('cloth.enterstock', compact('data'));
    }

    public function action(Request $request)
    {
       if($request->ajax())
       {
        $output = '';
        $query = $request->get('query');
        if($query != '')
        {
            $data = Category::where('category', 'like', '%'.$query.'%')
          # ->orWhere('name', 'like', '%'.$query.'%')
        /** ->orWhere('City', 'like', '%'.$query.'%')
         ->orWhere('PostalCode', 'like', '%'.$query.'%')
         ->orWhere('Country', 'like', '%'.$query.'%')**/
         ->orderBy('id', 'desc')
         ->get();
         
     }
     else
     {
         $data = DB::table('categories')
         ->orderBy('id', 'desc')
         ->get();
     }
     $total_row = $data->count();
     if($total_row > 0)
     {
         foreach($data as $row)
         {
          $output .= '

          <div class="col-sm-12 rst"
          data-category = "'.$row->category.'"
          data-amount = "'.$row->amount.'"
          data-exp = "'.$row->qty.'"
          style="cursor:pointer;"
          >'.$row->category.'</div>';
      }
  }
  else
  {
   $output = '
   <tr>
   <td align="center" colspan="5">No Data Found</td>
   </tr>
   ';
}
$data = array(
   'table_data'  => $output,
   'total_data'  => $total_row
);

echo json_encode($data);
}
}

public function stockenter(Request $request)
{
    //GETTING THE NAME OF THE CUSTOMER
    $code = Session::get('code');
    $data = Customer::where('cus_id', $code)->get();
    foreach ($data as $row) {
        $name = $row->name;
    }
    $num = count($_POST['qty']);
    for ($i=0; $i < $num; $i++) { 
        Stock::create([
            'name' => $name,
            'cus_id' => $code,
            'tag' => $request['tag'],
            'category' => $request['category'][$i],
            'qty' => $request['qty'][$i],
            'price' => $request['price'][$i],
            'info' => $request['info'][$i],
            'exp' => $request['exp'][$i],
            'fold' => $request['fold'][$i],
        ]);
    }
    Session::put('tag', $request['tag']);
    return redirect('addinfo');
    
}

public function addinfo()
{
    return view('cloth.addinfo');
}

public function payment()
{
    //$tag = Session::put('tag', 59661856);
    $tag = Session::get('tag');
    $data = Stock::where('tag', $tag)->get();
    return view('cloth.payment', compact('data'));
}

public function addpayment(Request $request)
{
    $request->validate([
        'total' => 'required',
        'deposit' => 'required',
    ]);
    $tag = Session::get('tag');
    Stock::where('tag', $tag)
    ->update([
        'collect_date' => $request['collect'],
        'deposit' => $request['deposit'],
        'balance' => $request['balance'],
        'discount' => $request['discount'],
    ]);
    return redirect('receipt');
}

public function receipt()
{
    //$tag = Session::put('tag', 7572792);
    $tag = Session::get('tag');
    $data = Stock::where('tag', $tag)->get();
    //GETTING THE CUSTOMER INFORMATION
    foreach ($data as $row) {
        $cus_id = $row->cus_id;
    }
    $data2 = Customer::where('cus_id', $cus_id)->get();
    return view('cloth.receipt', compact('data','data2'));
}

public function breakdown($id)
{
    $data = Stock::where('tag', $id)->get();
    return view('cloth.breakdown', compact('data'));
}

public function returnstock()
{
    return view('cloth.returnstock');
}

public function searchtag(Request $request)
{
    $request->validate([
        'tag' => 'required'
    ]);
    $data = Stock::where('tag', $request['tag'])
    ->where('status', 0)->get();
    if ($data->isEmpty()) {
        Session::flash('error', 'no record found');
        return redirect('returnstock');
    }
    Session::put('tag', $request['tag']);
    return redirect('chkreturn');
}

public function chkreturn()
{
    //$tag = Session::get('tag');
    //$tag = Session::put('tag', 7572792);
    $tag = Session::get('tag');
    $data = Stock::where('tag', $tag)->get();
    //GETTING THE CUSTOMER INFORMATION
    foreach ($data as $row) {
        $cus_id = $row->cus_id;
    }
    $data2 = Customer::where('cus_id', $cus_id)->get();
    $data = Stock::where('tag', $tag)->get();
    return view('cloth.chkreturn', compact('data','data2'));
}

public function confirmbalance()
{
    $tag = Session::get('tag');
    $dt = date('Y-m-d');
    Stock::where('tag', $tag)
    ->update([
        'balance_paid' => $dt,
        'status' => 1,
    ]);
    return redirect('printreturn');
}

public function printreturn()
{
    $tag = Session::get('tag');
    $data = Stock::where('tag', $tag)->get();
    //GETTING THE CUSTOMER INFORMATION
    foreach ($data as $row) {
        $cus_id = $row->cus_id;
    }
    $data2 = Customer::where('cus_id', $cus_id)->get();
    return view('cloth.printreturn', compact('data','data2'));
}

public function clothesin()
{
    return view('cloth.clothesin');
}

public function searchclothes(Request $request)
{
    $request->validate([
        'start_date' => 'required',
        'end_date' => 'required',
    ]);
    $start = $request['start_date'].' 00:00:00';
    $end = $request['end_date'].' 23:59:59';
    Session::put('start', $start);
    Session::put('end', $end);
    return redirect('allclothes');
}

public function allclothes()
{
    $start = Session::get('start');
    $end = Session::get('end');
    $data = Stock::where('created_at', '>=', $start)
    ->where('created_at', '<=', $end)->get();
    return view('cloth.allclothes', compact('data'));
}

public function income()
{
    return view('cloth.income');
}

public function searchincome(Request $request)
{
    $request->validate([
        'start_date' => 'required',
        'end_date' => 'required',
    ]);
    $start = $request['start_date'].' 00:00:00';
    $end = $request['end_date'].' 23:59:59';
    Session::put('start', $start);
    Session::put('end', $end);
    return redirect('allincome');
}

public function allincome()
{
    $start = Session::get('start');
    $end = Session::get('end');
    $data = Stock::where('created_at', '>=', $start)
    ->where('created_at', '<=', $end)->get();
    return view('cloth.allincome', compact('data'));
}

public function clothesout()
{
    return view('cloth.clothesout');
}

public function searchclothesout(Request $request)
{
    $request->validate([
        'start_date' => 'required',
        'end_date' => 'required',
    ]);
    $start = $request['start_date'].' 00:00:00';
    $end = $request['end_date'].' 23:59:59';
    Session::put('start', $start);
    Session::put('end', $end);
    return redirect('allclothesout');
}

public function allclothesout()
{
    $start = Session::get('start');
    $end = Session::get('end');
    $data = Stock::where('created_at', '>=', $start)
    ->where('created_at', '<=', $end)
    ->where('status', 1)->get();
    return view('cloth.allclothesout', compact('data'));
}

public function worker()
{
    $data = User::all();
    return view('cloth.worker', compact('data'));
}

public function addworker()
{
    return view('cloth.addworker');
}

public function registerworker(Request $request)
{
    $request->validate( [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
    User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'type' => 1,
        'password' => Hash::make($request['password']),
    ]);
    Session::flash('success', 'worker added successfully');
    return redirect('worker');
}

public function editworker($id)
{
    $data = User::where('id', $id)->get();
    return view('cloth.editworker', compact('data'));
}

public function updateworker(Request $request)
{
    $request->validate( [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
    User::where('email', $request['email'])
    ->update([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),
    ]);
    Session::flash('success', 'worker updated successfully');
    return redirect('worker');
}

public function deleteworker($id)
{
    $data = User::where('id', $id)->delete();
    Session::flash('error', 'worker delete() successfully');
    return redirect('worker');
}

public function service()
{
        $data = Service::all();
    return view('cloth.service', compact('data'));
}

public function addservice()
{
    return view('cloth.addservice');
}

public function enterservice(Request $request)
{
    $request->validate([
        'service' => 'required|unique:services',
        'price' => 'required'
    ]);
    Service::create([
        'service' => $request['service'],
        'price' => $request['price'],
    ]);
    Session::flash('success', 'additional services added successfully');
    return redirect('services');
}

public function editservice($id)
{
    $data = Service::where('id', $id)->get();
    return view('cloth.editservice', compact('data'));
}

public function updateservice(Request $request)
{
    $request->validate([
        'service' => 'required',
        'price' => 'required'
    ]);
    Service::where('id', $request['id'])
    ->update([
        'service' => $request['service'],
        'price' => $request['price'],
    ]);
    Session::flash('success', 'additional services updated successfully');
    return redirect('services');
}

public function deleteservice($id)
{
    $data = Service::where('id', $id)->delete();
    Session::flash('error', 'Service delete successfully');
    return redirect('services');
}

public function action2(Request $request)
    {
       if($request->ajax())
       {
        $output = '';
        $query = $request->get('query');
        if($query != '')
        {
            $data = Service::where('service', 'like', '%'.$query.'%')
          # ->orWhere('name', 'like', '%'.$query.'%')
        /** ->orWhere('City', 'like', '%'.$query.'%')
         ->orWhere('PostalCode', 'like', '%'.$query.'%')
         ->orWhere('Country', 'like', '%'.$query.'%')**/
         ->orderBy('id', 'desc')
         ->get();
         
     }
     else
     {
         $data = DB::table('services')
         ->orderBy('id', 'desc')
         ->get();
     }
     $total_row = $data->count();
     if($total_row > 0)
     {
         foreach($data as $row)
         {
          $output .= '

          <div class="col-sm-12 rst"
          data-service = "'.$row->service.'"
          data-amount = "'.$row->price.'"
          style="cursor:pointer;"
          >'.$row->service.'</div>';
      }
  }
  else
  {
   $output = '
   <tr>
   <td align="center" colspan="5">No Data Found</td>
   </tr>
   ';
}
$data = array(
   'table_data'  => $output,
   'total_data'  => $total_row
);

echo json_encode($data);
}
}

public function aditionalservice(Request $request)
{
    $num = count($_POST['service']);
    for ($i=0; $i < $num; $i++) {
        AddService::create([
            'service' => $request['service'][$i],
            'qty' => $request['qty'][$i],
            'tag' => $request['tag'],
            'price' => $request['price'][$i],
        ]); 
    }
    $data = AddService::where('tag', $request['tag'])->get();
    $sum = 0;
    foreach ($data as $row) {
        $sum += $row->price * $row->qty;
    }
    Stock::where('tag', $request['tag'])
    ->update([
        'addamount' => $sum
    ]);
    return redirect('selectcolor');
}

public function selectcolor()
{
    $data = Color::all();
    return view('cloth.selectcolor', compact('data'));
}

public function tag()
{
    return view('cloth.tag');
}

public function printtag(Request $request)
{
    $request->validate([
        'tag' => 'required'
    ]);
    $data = Stock::where('tag', $request['tag'])->get();
    if ($data->isEmpty()) {
        Session::flash('error', 'no record found');
    }
    Session::put('tag', $request['tag']);
    return redirect('tagprint');
}

public function tagprint()
{
    $tag = Session::get('tag');
    $data = Stock::where('tag', $tag)->get();
    //dd($tag);
    return view('cloth.tagprint', compact('data'));
}

public function color()
{
    $data = Color::all();
    return view('cloth.color', compact('data'));
}

public function addcolor()
{
    return view('cloth.addcolor');
}

public function entercolor(Request $request)
{
    $request->validate([
        'color' => 'required|unique:colors',
    ]);
    Color::create([
        'color' => $request['color'],
    ]);
    Session::flash('success', 'color added successfully');
    return redirect('color');
}

public function editcolor($id)
{
    $data = Color::where('id', $id)->get();
    return view('cloth.editcolor', compact('data'));
}

public function updatecolor(Request $request)
{
    $request->validate([
        'color' => 'required|unique:colors',
    ]);
    Color::where('id', $request['id'])
    ->update([
        'color' => $request['color'],
    ]);
    Session::flash('success', 'color update successfully');
    return redirect('color');
}

public function deletecolor($id)
{
    Color::where('id', $id)->delete();
    Session::flash('error', 'deleted successfully');
    return redirect('color');
}




}

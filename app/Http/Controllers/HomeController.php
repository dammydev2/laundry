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
use App\AddColor;
use App\Payment;
use App\Ironer;

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
            'category' => 'required|unique:categories',
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
            'cus_id' => 'MAG'.$random,
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
        $data = Stock::select('tag')->orderBy('id', 'desc')->distinct();
        //dd($data);
        return view('cloth.stock', compact('data'));
    }

    public function addstock()
    {
        $data = Customer::orderBy('name', 'asc')->get();
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
        $data2 = Stock::orderBy('id', 'desc')->first();
        $data3 = Color::orderBy('color', 'asc')->get();
        return view('cloth.enterstock', compact('data','data2','data3'));
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
    Session::put('name', $name);
    $num = count($_POST['qty']);
    for ($i=0; $i < $num; $i++) { 
        //checking if its iron only
        if ($request['tp'][$i] == 'Iron') {
            $price[] = $request['price'][$i] / 2;
        }
        else{
            $price[] = $request['price'][$i];
        }
        print_r($price[$i]);
        Stock::create([
            'name' => $name,
            'cus_id' => $code,
            'tag' => $request['tag'],
            'category' => $request['category'][$i],
            'qty' => $request['qty'][$i],
            'price' => $price[$i],
            'info' => $request['info'][$i],
            'exp' => $request['exp'][$i],
            'fold' => $request['fold'][$i],
            'servicetype' => $request['tp'][$i],
            'location' => \Auth::User()->location,
            'totalCloth' => $request['tcolth']
        ]);
    }
    //entering into color
    $num = count($request['color']);
    for ($i=0; $i < $num; $i++) { 
        AddColor::create([
            'tag' => $request['tag'],
            'color' => $request['color'][$i],
            'qty' => $request['color_qty'][$i],
            'category' => $request['cloth'][$i],
        ]);
    }
    Session::put('tag', $request['tag']);
    return redirect('addinfo');
    
}

public function addinfo()
{
    $tag = Session::get('tag');
    $data = Service::all();
    $data2 = AddColor::where('tag', $tag)->get();
    return view('cloth.addinfo', compact('data','data2'));
}

public function payment()
{
    //$tag = Session::put('tag', 10436);
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
        'hanger' => $request['hanger'],
        'express' => $request['express']
    ]);
    Payment::create([
        'tag' => Session::get('tag'),
        'name' => Session::get('name'),
        'amount' => $request['deposit'],
        'balance' => $request['balance'],
        'type' => 'Deposit',
        'method' => $request['type']
    ]);
    return redirect('receipt');
}

public function receipt()
{
    $tag = Session::get('tag');
    $data = Stock::where('tag', $tag)->get();
    //GETTING THE CUSTOMER INFORMATION
    foreach ($data as $row) {
        $cus_id = $row->cus_id;
    }
    $data2 = Customer::where('cus_id', $cus_id)->get();
    $data3 = AddColor::where('tag', $tag)->get();
    $data4 = AddService::where('tag', $tag)->get();
    return view('cloth.receipt', compact('data','data2','data3','data4'));
}

public function breakdown($id)
{
    $data = Stock::where('tag', $id)->get();
    return view('cloth.breakdown', compact('data'));
}

public function returnstock()
{
    $data = Payment::orderBy('name', 'asc')->get();
    return view('cloth.returnstock', compact('data'));
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
    $data3 = AddColor::where('tag', $tag)->get();
    $data4 = AddService::where('tag', $tag)->get();
    $getTag = Payment::where('tag', $tag)->first();
    return view('cloth.chkreturn', compact('data','data2','data3','data4','getTag'));
}

public function confirmbalance(Request $request)
{
    $tag = Session::get('tag');
    $dt = date('Y-m-d');
    Stock::where('tag', $tag)
    ->update([
        'balance_paid' => $dt,
        'status' => 1,
    ]);
    Payment::create([
        'tag' => Session::get('tag'),
        'name' => $request['name'],
        'amount' => $request['amount'],
        'balance' => 0,
        'name' => $request['name'],
        'type' => 'balance',
        'method' => $request['method'],
        'collect' => 1
    ]);
    Payment::where('tag', Session::get('tag'))
    ->update([
        'collect' => 1
    ]);
           // return redirect('chkreturn');
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
    $data = Payment::where('created_at', '>=', $start)
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
        'location' => $request['location'],
        'type' => $request['type'],
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
    $data = Service::orderBy('service','asc')->get();
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
            'tag' => Session::get('tag'),
            'category' => $request['category'][$i],
        ]); 
    }

    //updating the price
    $data = AddService::where('tag', Session::get('tag'))->get();
    foreach ($data as $row) {
        $service = $row->service;
        $data2 = Service::where('service', $service)->get();
        foreach ($data2 as $get) {
            $price = $get->price;
            AddService::where('service', $service)
            ->update([
                'price' => $price,
            ]);
        }

    }
    $data = AddService::where('tag', Session::get('tag'))->get();
    $sum = 0;
    foreach ($data as $row) {
        $sum += $row->price * $row->qty;
    }
   // dd($sum);
    Stock::where('tag', Session::get('tag'))
    ->update([
        'addamount' => $sum
    ]);
    return redirect('payment');
}

public function selectcolor()
{
    $tag = Session::get('tag');
    $data = Color::all();
    $data2 = Stock::where('tag', $tag)->get();
    return view('cloth.selectcolor', compact('data','data2'));
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
    //dd($data);
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

public function inputcolor(Request $request)
{
    $num = count($request['category']);
    for ($i=0; $i < $num; $i++) { 
        AddColor::create([
            'tag' => Session::get('tag'),
            'category'=> $request['category'][$i],
            'service'=> $request['service'][$i],
            'qty'=> $request['qty'][$i],
        ]);
    }
    return redirect('payment');
}

public function ironer()
{
    return view('cloth.ironer');
}

public function ironertag(Request $request)
{
    $request->validate([
        'tag' => 'required'
    ]);
    $data = Stock::where('tag', $request['tag'])
    ->where('status', 0)->get();
    if ($data->isEmpty()) {
        Session::flash('error', 'no record found');
        return redirect('ironer');
    }
    Session::put('tag', $request['tag']);
    return redirect('addironer');
}

public function addironer()
{
    $tag = Session::get('tag');
    $data = Stock::where('tag', $tag)->get();
    //dd($tag);
    return view('cloth.addironer', compact('data'));
}

public function inputironer(Request $request)
{
    //dd($request);
    $num = count($request['ironer']);
    for ($i=0; $i < $num; $i++) { 
        Ironer::create([
            'tag' => $request['tag'],
            'tagno' => $request['tagno'][$i],
            'ironer' => $request['ironer'][$i],
        ]);
    }
    Session::flash('success', 'ironer added');
    return redirect('ironer');
}

public function chkironer()
{
    return view('cloth.chkironer');
}

public function searchironer(Request $request)
{
    $request->validate([
        'tag' => 'required'
    ]);
    $data = Ironer::where('tag', $request['tag'])->get();
    if ($data->isEmpty()) {
        Session::flash('error', 'no record found');
        return redirect('chkironer');
    }
    Session::put('tag', $request['tag']);
    return redirect('viewironer');
}

public function viewironer()
{
    $tag = Session::get('tag');
    $data = Ironer::where('tag', $tag)->get();
    //dd($tag);
    return view('cloth.viewironer', compact('data'));
}

public function collected($tag)
{
    Payment::where('tag', $tag)
    ->update([
        'collect' => 1
    ]);
    Session::flash('success', 'mark as collected');
           // return redirect('chkreturn');
    return redirect('chkreturn');
}



}

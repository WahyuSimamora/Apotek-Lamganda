<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Medicine;
use App\Models\OrderItem;
use App\Models\Notification;
use Hash;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $notification = Notification::where('is_read', '=', '0')->orderBy('updated_at', 'DESC')->get()->unique('medicine_id');;

        // dd(count($notification));
        return view('admin.dashboard', compact('notification'));
    }

    public function orders(Request $request)
    {
        // $orders = Order::where('status', '=', 'Checking Admin')->orderBy('created_at', 'DESC')->with(['user', 'order_items'])->get();
        $orders = Order::whereIn('status', ['Checking Admin', 'Berhasil', 'Ditolak Karyawan', 'Ditolak Admin', 'Dibatalkan Customer', 'Disetujui Admin', 'Disetujui Karyawan'])->orderBy('updated_at', 'DESC')->with(['user', 'order_items'])->paginate(8);

        // dd(json_decode($orders));
        // dd( request()->all() );
        // dd($status);

        return view('admin.orders.list', compact('orders'));
    }

    public function searchOrder(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->keyword;
        $status = $request->get('status');
        $date = $request->get('daterange');


		$users = User::orderBy('created_at', 'DESC')->where('role', '=', 'customer')->where('name', 'LIKE', "%".$keyword."%")->get();
        $user_id = array();

        foreach ($users as $user) {
            array_push($user_id, $user->id);
        }
        $orders;

        // dd($user_id);

        if($status != null) {
            // dd($status);
                        // \DB::enableQueryLog();

            // $orders = Order::join('users', 'orders.user_id', '=', 'users.id')->join('order_items', 'order_items.order_id', '=', 'order_items.id')->where('status', '=', 'Ditolak Admin')->whereIn('orders.user_id', $user_id)->paginate(8);
            $orders = Order::where('status', '=', $status)->orderBy('updated_at', 'DESC')->with(['user', 'order_items'])->whereIn('orders.user_id', $user_id)->paginate(8);

            // dd($orders);
            // dd(\DB::getQueryLog());

            // dd($orders);
            // $orders = Order::pagination(8)->with(['user', 'order_items'])->where('status', '=', $status)->whereIn('user_id', $user_id);
        } else {
            $orders = Order::whereIn('status', ['Checking Admin', 'Berhasil', 'Ditolak Karyawan', 'Ditolak Admin', 'Dibatalkan Customer', 'Disetujui Admin', 'Disetujui Karyawan'])->orderBy('updated_at', 'DESC')->with(['user', 'order_items'])->whereIn('orders.user_id', $user_id)->paginate(8);
            // $orders = Order::join('users', 'orders.user_id', '=', 'users.id')->join('order_items', 'order_items.order_id', '=', 'order_items.id')->whereIn('user_id', $user_id)->whereIn('status', ['Checking Admin', 'Berhasil', 'Dibatalkan', 'Dibatalkan User'])->pagination(8);
        }

        if($date) {
            $date_range = explode('- ', $date);
            $start_date = $date_range[0];
            $start_date = explode('/', $start_date);
            // get year
            $start_date_year = $start_date[2];
            $start_date_month = $start_date[0];
            $start_date_date = $start_date[1];
            $start_date_year = str_replace(' ', '', $start_date_year);
            $start_date = $start_date_year .'-'. $start_date_month .'-'. $start_date_date;
            $start_date .= ' 00:00:00';

            // dd($start_date);


            $end_date = $date_range[1];
            $end_date = explode('/', $end_date);

            // dd($end_date);
            // get year
            $end_date_year = $end_date[2];
            $end_date_month = $end_date[0];
            $end_date_date = $end_date[1];
            $end_date = $end_date_year .'-'. $end_date_month .'-'. $end_date_date;
            $end_date .= ' 00:00:00';

            // dd($start_date, $end_date);
            // \DB::enableQueryLog();

            // Your Eloquent query executed by using get()

            $orders = Order::whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date)->whereIn('status', ['Checking Admin', 'Berhasil', 'Ditolak Karyawan', 'Ditolak Admin', 'Dibatalkan Customer', 'Disetujui Admin', 'Disetujui Karyawan'])->orderBy('updated_at', 'DESC')->paginate(8);
            // dd(\DB::getQueryLog());

            // dd($orders);
        }

        return view('admin.orders.list', compact('orders'));
	}

    public function approveOrder(Request $request) {
        $order_id = $request->order_id;
        $auth_user = auth()->user();

        // update quantity product
        $order_items = OrderItem::with(['medicine', 'order'])->where('order_id', '=', $order_id)->get();
        foreach ($order_items as $item) {
            Medicine::find($item->medicine_id)->update([
                'stock' => $item['medicine']['stock'] - $item->quantity
            ]);

            if(($item['medicine']['stock'] - $item->quantity) < 50) {
                // dd($item['medicine']['stock'] - $item->quantity);
                Notification::create([
                    'medicine_id' => $item->medicine_id,
                    'medicine_name' => $item->medicine_name,
                    'medicine_stock'=> $item['medicine']['stock'] - $item->quantity,
                    'is_read'=> 0,
                ]);
            }
        }

        Order::find($order_id)->update([
            'status' => 'Disetujui' .' '. ucfirst($auth_user->role)
        ]);
        return redirect('/dashboard/order-management');
    }

    public function rejectOrder(Request $request) {
        $order_id = $request->order_id;
        $auth_user = auth()->user();

        Order::find($order_id)->update([
            'status' => 'Ditolak' .' '. ucfirst($auth_user->role)
        ]);
        return redirect('/dashboard/order-management');
    }

    public function takenOrder(Request $request) {
        $order_id = $request->order_id;

        Order::find($order_id)->update([
            'status' => 'Berhasil Diambil'
        ]);
        return redirect('/dashboard/order-management');
    }

    public function deleteOrder(Request $request) {
        $order_id = $request->order_id;

        Order::find($order_id)->delete();
        return redirect('/dashboard/order-management');
    }

    public function getDetailOrder(Request $request)
    {
        $order_id = $request->order_id;
        $orders = OrderItem::with(['medicine', 'order'])->where('order_id', '=', $order_id)->get();
        // dd(json_decode($orders));
        return view('admin.orders.detail', compact('orders'));
    }

    public function getMedicines()
    {
        $medicines = Medicine::orderBy('updated_at', 'desc')->paginate(8);
        $expired_dates = array();
        $status = array();

        foreach ($medicines as $medicine) {
            // dd($medicine);
            array_push($expired_dates, $medicine->expired_date);
        }

        $today = date("Y-m-d H:i:s");

        foreach ($expired_dates as $expired_date) {
            // dd($today, $expired_date);

            if($expired_date > $today) {
                array_push($status, "Belum Expired");
            } else {
                array_push($status, "Expired");
            }
        }

        // dd($status);


        return view('admin.medicines.list', compact('medicines', 'status'));
    }

    public function createMedicine() {
        return view('admin.medicines.create');
    }

    public function storeMedicine(Request $request) {
        $input = $request->all();

        $check = Medicine::where('code', '=', $request['code'])->first();
        if($check) {
            return redirect("/dashboard/medicine-management/create")->with(['medicine_validation' => 'The credentials do not match our records']);
        }

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "/images/$profileImage";
        }

        $insert = Medicine::create($input);

        if ($request->stock < 50) {
            Notification::create([
                'medicine_id' => $insert->id,
                'medicine_name' => $request->name,
                'medicine_stock'=> $request->stock,
                'is_read'=> 0,
            ]);
        }

        return redirect('/dashboard/medicine-management');
    }

    public function deleteMedicine(Request $request) {
        $medicine_id = $request->medicine_id;

        Medicine::find($medicine_id)->delete();
        return redirect('/dashboard/medicine-management');
    }

    public function editMedicine(Request $request) {
        $medicine_id = $request->medicine_id;
        // dd($medicine_id);
        $medicine = Medicine::where('id', '=', $medicine_id)->first();
        // dd($medicine);

        return view('admin.medicines.edit', compact('medicine'));
    }

    public function updateMedicine(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'detail' => 'required'
        // ]);
        $medicine_id = $request->medicine_id;
        $input = $request->all();
        // dd($input);
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "/images/$profileImage";
        }else{
            unset($input['image']);
        }
        $updated = Medicine::find($medicine_id)->update($input);

        // dd($request);
        if ($request->stock > 50) {
            Notification::where('medicine_id', '=', $medicine_id)->update([
                'is_read' => 1
            ]);
        }
        // $updated = $medicine->update($input);
        // dd($updated);

        return redirect("/dashboard/medicine-management");
    }

    public function searchMedicine(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->keyword;
		$expired_date = $request->expired_date;
        // dd($expired_date);
        $expired_dates = array();
        $status = array();

        if($keyword) {
            $medicines = Medicine::where('name', 'LIKE', "%".$keyword."%")->paginate(8);
            foreach ($medicines as $medicine) {
                // dd($medicine);
                array_push($expired_dates, $medicine->expired_date);
            }
        }

        if($expired_date) {
            $medicines = Medicine::whereDate('expired_date','=',$expired_date)->paginate(8);
            foreach ($medicines as $medicine) {
                // dd($medicine);
                array_push($expired_dates, $medicine->expired_date);
            }
        }

        $today = date("Y-m-d H:i:s");

        foreach ($expired_dates as $expired_date) {
            // dd($today, $expired_date);

            if($expired_date > $today) {
                array_push($status, "Belum Expired");
            } else {
                array_push($status, "Expired");
            }
        }

        if(!$keyword && !$expired_date) {
            $medicines = Medicine::paginate(8);

            foreach ($medicines as $medicine) {
                // dd($medicine);
                array_push($expired_dates, $medicine->expired_date);
            }

            $today = date("Y-m-d H:i:s");

            foreach ($expired_dates as $expired_date) {
                // dd($today, $expired_date);

                if($expired_date > $today) {
                    array_push($status, "Belum Expired");
                } else {
                    array_push($status, "Expired");
                }
            }
            return view('admin.medicines.list', compact('medicines', 'status'));
        }

        return view('admin.medicines.list', compact('medicines', 'status'));
	}

    public function getUsers()
    {
        $users = User::paginate(8);
        return view('admin.users.list', compact('users'));
    }

    public function createUser() {
        return view('admin.users.create');
    }

    public function storeUser(Request $request) {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        User::create($input);

        return redirect('/dashboard/user-management');
    }

    public function deleteUser(Request $request) {
        $user_id = $request->user_id;

        User::find($user_id)->delete();
        return redirect('/dashboard/user-management');
    }

    public function editUser(Request $request) {
        $user_id = $request->user_id;
        $user = User::where('id', '=', $user_id)->first();

        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request)
    {
        $user_id = $request->user_id;
        $input = $request->all();

        $updated = User::find($user_id)->update($input);

        return redirect("/dashboard/user-management");
    }

    public function searchUser(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->keyword;
		$users = User::where('name', 'LIKE', "%".$keyword."%")->paginate(8);

        return view('admin.users.list', compact('users'));
	}

    public function orderHistory(Request $request) {
        // dd("sda");
        $orders = Order::whereIn('status', ['Berhasil Diambil'])->orderBy('updated_at', 'DESC')->with(['user', 'order_items'])->paginate(8);

        return view('admin.history.list', compact('orders'));
    }

    public function getDetailHistory(Request $request) {
        $order_id = $request->order_id;
        $orders = OrderItem::with(['medicine', 'order'])->where('order_id', '=', $order_id)->get();
        // dd(json_decode($orders));
        return view('admin.history.detail', compact('orders'));
    }


    public function searchHistory(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->keyword;
        $status = $request->get('status');
        $date = $request->get('daterange');


		$users = User::orderBy('created_at', 'DESC')->where('name', 'LIKE', "%".$keyword."%")->get();
        $user_id = array();

        foreach ($users as $user) {
            array_push($user_id, $user->id);
        }

        $orders;
        // dd($user_id);
        if($status != null) {
            $orders = Order::with(['user', 'order_items'])->where('status', '=', $status)->whereIn('user_id', $user_id)->paginate(8);
        } else {
            $orders = Order::with(['user', 'order_items'])->whereIn('user_id', $user_id)->whereIn('status', ['Berhasil Diambil'])->orderBy('created_at', 'DESC')->paginate(8);
        }

        if($date) {
            $date_range = explode('- ', $date);
            $start_date = $date_range[0];
            $start_date = explode('/', $start_date);
            // get year
            $start_date_year = $start_date[2];
            $start_date_month = $start_date[0];
            $start_date_date = $start_date[1];
            $start_date_year = str_replace(' ', '', $start_date_year);
            $start_date = $start_date_year .'-'. $start_date_month .'-'. $start_date_date;
            $start_date .= ' 00:00:00';

            // dd($start_date);


            $end_date = $date_range[1];
            $end_date = explode('/', $end_date);

            // dd($end_date);
            // get year
            $end_date_year = $end_date[2];
            $end_date_month = $end_date[0];
            $end_date_date = $end_date[1];
            $end_date = $end_date_year .'-'. $end_date_month .'-'. $end_date_date;
            $end_date .= ' 00:00:00';

            // dd($start_date, $end_date);
            // \DB::enableQueryLog();

            // Your Eloquent query executed by using get()

            $orders = Order::whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date)->whereIn('status', ['Berhasil Diambil'])->orderBy('updated_at', 'DESC')->paginate(8);
            // dd(\DB::getQueryLog());

            // dd($orders);
        }

        return view('admin.history.list', compact('orders'));
	}
}

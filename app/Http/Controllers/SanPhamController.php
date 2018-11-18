<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductType;

class SanPhamController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | get view to display all products 
    |-------------------------------------------------------------------------- 
    | 
    */
     public function getDanhSach() {
        $sanpham = Product::get();
    	return view('admin.sanpham.danhsach', ['sanpham'=>$sanpham]);
    }

    /*
    |--------------------------------------------------------------------------
    | get view to add new  product
    |-------------------------------------------------------------------------- 
    | 
    */
    public function getThem() {
    	$theloai = ProductType::all();
    	return view('admin.sanpham.them', ['theloai'=>$theloai]);
    }

    /*
    |--------------------------------------------------------------------------
    | add new product to database 
    |--------------------------------------------------------------------------
    | input: $request is all information of products
    | output: add new product in database if success
    |         else, show error
    | check name, quntity, maker, price, kind of product and kind of file
    | show error if had
    | if product has promotion_price <= 0 show error
    | show success message if add product successfull
    | 
    */
    public function postThem(Request $request) {
        $this->validate($request,
            [
                'name'=>'required|unique:products,name|min:3|max:100',
                'quantity'=>'required|integer',
                'maker'=>'required',
                'unit_price'=>'required',
                'TheLoai'=>'required',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên sản phẩm.',
                'name.unique'=>'Tên sản phẩm đã tồn tại.',
                'name.min'=>'Tên sản phẩm phải nhập có độ dài từ 3 đến 100 kí tự.',
                'name.max'=>'Tên sản phẩm phải nhập có độ dài từ 3 đến 100 kí tự.',
                'quantity.required'=>'Chưa điền số lượng sản phẩm',
                'quantity.integer'=>'Số lượng của sản phẩm phải là số nguyên',
                'maker.required'=>'Chưa điền nhãn hiệu sản phẩm.',
                'unit_price.required'=>'Chưa nhập giá gốc của sản phẩm.',
                'TheLoai'=>'Chưa chọn thể loại.',
            ]);

        $sanpham = new Product();
        $sanpham->name = $request->name;
        $sanpham->maker = $request->maker;
        $sanpham->description = $request->description;
        $sanpham->id_type = $request->TheLoai;
        $sanpham->new = $request->new;

        if($request->quantity < 0)
            return redirect('admin/sanpham/them')->with('loi_quantity', 'Số lượng phải lớn hơn 0');
        $sanpham->quantity = $request->quantity;

        if((float)$request->unit_price > 0)
            $sanpham->unit_price = (float)$request->unit_price;
        else
            return redirect('admin/sanpham/them')->with('loi_unit', 'Giá gốc phải lớn hơn 0');

        if(($request->promotion_price) && ($request->promotion_price > 0))
            $sanpham->promotion_price = (float)$request->promotion_price;
        else if(($request->promotion_price) && $request->promotion_price <= 0)
            return redirect('admin/sanpham/them')->with('loi_promotion', 'Giá khuyến mãi phải lớn hơn 0');

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
               return redirect('admin/sanpham/them')->with('loi', 'Chỉ được chọn file jpg, png, jpeg'); 
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("source/image/product/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move('source/image/product', $Hinh);
            $sanpham->image = $Hinh;
        }
        else{
            $sanpham->image = "";
        }

        $sanpham->save();

        return redirect('admin/sanpham/them')->with('thongbao', 'Thêm thành công');
    }

    /*
    |--------------------------------------------------------------------------
    | get view to edit a product
    |-------------------------------------------------------------------------- 
    | 
    */
    public function getSua($id) {
    	$theloai = ProductType::all();
    	$sanpham = Product::find($id);
        return view('admin.sanpham.sua', ['sanpham'=>$sanpham, 'theloai'=>$theloai]);
    }

    /*
    |--------------------------------------------------------------------------
    | edit new product to database 
    |--------------------------------------------------------------------------
    | input: $request is all information of products
    | output: edit new product in database if success
    |         else, show error
    | check name, quntity, maker, price, kind of product and kind of file
    | show error if had
    | if product has promotion_price <= 0 show error
    | show success message if edit product successfull
    | 
    */
    public function postSua(Request $request, $id) {
        $sanpham = Product::find($id);
        $this->validate($request,
            [
                'name'=>'required|min:3|max:100|unique:products,name,'.$id,
                'quantity'=>'required|integer',
                'maker'=>'required',
                'unit_price'=>'required',
                'TheLoai'=>'required',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên sản phẩm.',
                'name.unique'=>'Tên sản phẩm đã tồn tại.',
                'name.min'=>'Tên sản phẩm phải nhập có độ dài từ 3 đến 100 kí tự.',
                'name.max'=>'Tên sản phẩm phải nhập có độ dài từ 3 đến 100 kí tự.',
                'quantity.required'=>'Chưa điền số lượng sản phẩm',
                'quantity.integer'=>'Số lượng của sản phẩm phải là số nguyên',
                'maker.required'=>'Chưa điền nhãn hiệu sản phẩm.',
                'unit_price.required'=>'Chưa nhập giá gốc của sản phẩm.',
                'TheLoai'=>'Chưa chọn thể loại.',
            ]);

        $sanpham->name = $request->name;
        $sanpham->maker = $request->maker;
        $sanpham->description = $request->description;
        $sanpham->id_type = $request->TheLoai;
        $sanpham->new = $request->new;
        
        if($request->quantity < 0)
            return redirect('admin/sanpham/sua/'.$id)->with('loi_quantity', 'Số lượng phải lớn hơn 0');
        $sanpham->quantity = $request->quantity;

        if($request->unit_price > 0)
            $sanpham->unit_price = (float)$request->unit_price;
        else
            return redirect('admin/sanpham/sua/'.$id)->with('loi_unit', 'Giá gốc phải lớn hơn 0');

        if(($request->promotion_price) && ($request->promotion_price > 0))
            $sanpham->promotion_price = (float)$request->promotion_price;
        else if(($request->promotion_price) && $request->promotion_price <= 0)
            return redirect('admin/sanpham/sua/'.$id)->with('loi_promotion', 'Giá khuyến mãi phải lớn hơn 0');

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'bmp'){
               return redirect('admin/sanpham/sua/'.$id)->with('loi', 'Chỉ được chọn file jpg, png, jpeg, bmp'); 
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("source/image/product/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move('source/image/product', $Hinh);
            
            if($sanpham->image != "") 
                unlink("source/image/product/".$sanpham->image);

            $sanpham->image = $Hinh;
        }

        $sanpham->save();

        return redirect('admin/sanpham/sua/'.$id)->with('thongbao','Sửa thành công.');
    }

    /*
    |--------------------------------------------------------------------------
    | remove a product from database
    |-------------------------------------------------------------------------- 
    | remove product and show success message
    |
    */
    public function getXoa($id) {
        $sanpham = Product::find($id);
        	
        $sanpham->delete();
        
        return redirect('admin/sanpham/danhsach')->with('thongbao', 'Xóa thành công.');
    }

}

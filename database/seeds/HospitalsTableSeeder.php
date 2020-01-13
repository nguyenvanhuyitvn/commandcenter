<?php

use Illuminate\Database\Seeder;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('hospitals')->delete();
        DB::table('hospitals')->insert(
            [
                ['id'=>1, "code"=>"ZERO", "name"=>"All", "logo"=>"avatar.jpg", "districts_id"=>'007', "provinces_id"=>'01', "wards_id"=>'00277',"address"=>"Giải Phóng","depts_id"=>1 ],
                ['id'=>2, "code" =>"BACHMAIHN", "name"=>"BV Bạch mai", "logo"=>"uploads/bachmai.jpg", "districts_id"=>'007', "provinces_id"=>'01', "wards_id"=>'00277',"address"=>"Giải Phóng","depts_id"=>1 ],
                ['id'=>3, "code" =>"CHAMCUUTW", "name"=>"BV Châm cứu trung ương", "logo"=>"uploads/cham-cuu-tw.jpg", "districts_id"=>'006', "provinces_id"=>'01', "wards_id"=>'00223',"address"=>"49 Thái Thịnh","depts_id"=>1 ],
                ['id'=>4, "code" =>"DALIEUTW", "name"=>"BV Da liễu trung ương", "logo"=>"uploads/da-lieu-tw.jpg", "districts_id"=>'006', "provinces_id"=>'01', "wards_id"=>'00232',"address"=>"15 Phương Mai","depts_id"=>1 ],
                ['id'=>5, "code" =>"DHY", "name"=>"BV Đại học Y Hà Nội", "logo"=>"uploads/dhy.jpg", "districts_id"=>'006', "provinces_id"=>'01', "wards_id"=>'00229',"address"=>"1 Tôn Thất Tùng","depts_id"=>1 ],
                ['id'=>6, "code" =>"HUUNGHI", "name"=>"BV Hữu Nghị", "logo"=>"uploads/huu-nghi.jpg", "districts_id"=>'007', "provinces_id"=>'01', "wards_id"=>'00244',"address"=>"1 Trần Khánh Dư","depts_id"=>1 ],
                ['id'=>7, "code" =>"HUUNGHIVIETDUC", "name"=>"BV Hữu Nghị Việt Đức", "logo"=>"uploads/huu-nghi-viet-duc.jpg", "districts_id"=>'002', "provinces_id"=>'01', "wards_id"=>'00076',"address"=>"40 Tràng Thi","depts_id"=>1 ],
                ['id'=>8, "code" =>"HUYETHOCTW", "name"=>"BV Huyết học truyền máu TW", "logo"=>"uploads/huyet-hoc-truyen-mau-tw.jpg", "districts_id"=>'005', "provinces_id"=>'01', "wards_id"=>'00172',"address"=>"Phạm Văn Bạch","depts_id"=>1 ],
                ['id'=>9, "code" =>"NHIETDOITW", "name"=>"BV Nhiệt đới TW", "logo"=>"uploads/nhiet-doi-tw.jpg", "districts_id"=>'006', "provinces_id"=>'01', "wards_id"=>'00277',"address"=>"78 Giải Phóng","depts_id"=>1 ],
                ['id'=>10, "code" =>"NHITW", "name"=>"BV Nhi TW", "logo"=>"uploads/nhi-tw.jpg", "districts_id"=>'006', "provinces_id"=>'01', "wards_id"=>'00187',"address"=>"18/879 Đường La Thành","depts_id"=>1 ],
                ['id'=>11, "code" =>"PHUSANTW", "name"=>"BV Phụ sản TW", "logo"=>"uploads/phu-san-tw.jpg", "districts_id"=>'002', "provinces_id"=>'01', "wards_id"=>'00076',"address"=>"43 Tràng Thi","depts_id"=>1 ],
                ['id'=>12, "code" =>"RANGHAMMATTW", "name"=>"BV Răng Hàm Mặt TW", "logo"=>"uploads/rang-ham-mat-tw.jpg", "districts_id"=>'002', "provinces_id"=>'01', "wards_id"=>'00076',"address"=>"40 Tràng Thi","depts_id"=>1 ],
                ['id'=>13, "code" =>"TUETINH", "name"=>"BV Tuệ Tĩnh", "logo"=>"uploads/tue-tinh.jpg", "districts_id"=>'268', "provinces_id"=>'01', "wards_id"=>'09541',"address"=>"2 Đường Trần Phú","depts_id"=>1 ],
                ['id'=>14, "code" =>"TAMTHANTW", "name"=>"BV Tâm thần Trung Ương", "logo"=>"uploads/tam-than-tw.jpg", "districts_id"=>'279', "provinces_id"=>'01', "wards_id"=>'10198',"address"=>"Xã Hòa Bình","depts_id"=>1 ],
            ]
        );
    }
}

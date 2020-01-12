<?php

use Illuminate\Database\Seeder;

class SeriousProblemTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   DB::table('serious_problem_types')->delete();
        DB::table('serious_problem_types')->insert(
        [
            // lv1
            ['id'=>1, "name"=>"Sự cố phẫu thuật", "parent_id"=>0, "content"=>"Sự cố phẫu thuật"],
            ['id'=>2, "name"=>"Sự cố do trang thiết bị", "parent_id"=>0, "content"=>"Sự cố do trang thiết bị"],
            ['id'=>3, "name"=>"Sự cố liên quan đến quản lý người bệnh", "parent_id"=>0, "content"=>"Sự cố liên quan đến quản lý người bệnh"],
            ['id'=>4, "name"=>"Sự cố liên quan đến chăm sóc tại cơ sở khám bệnh, chưa bệnh", "parent_id"=>0, "content"=>"Sự cố liên quan đến chăm sóc tại cơ sở khám bệnh, chưa bệnh"],
            ['id'=>5, "name"=>"Sự cố do môi trường", "parent_id"=>0, "content"=>"Sự cố do môi trường"],
            ['id'=>6, "name"=>"Sự cố được cho là phạm tội hình sự", "parent_id"=>0, "content"=>"Sự cố được cho là phạm tội hình sự"],
            // lv2 parent_id = 1
            ['id'=>7, "name"=>"Phẫu thuật sai vị trí (bộ phận cơ thể). Là phẫu thuật ở vị trí cơ thể người bệnh không đúng với những dữ kiện ghi trong hồ sơ bệnh, ngoại trừ những tình huống khẩn cấp như:", "parent_id"=>1, "content"=>"Phẫu thuật sai vị trí (bộ phận cơ thể). "],
            ['id'=>8, "name"=>"Phẫu thuật sai người bệnh. Là phẫu thuật trên người bệnh không đúng với những dữ kiện về nhận diện người bệnh ghi trong hồ sơ bệnh án", "parent_id"=>1, "content"=>"Phẫu thuật sai người bệnh. Là phẫu thuật trên người bệnh không đúng với những dữ kiện về nhận diện người bệnh ghi trong hồ sơ bệnh án"],
            ['id'=>9, "name"=>"Phẫu thuật sai phương pháp (sai quy trình) gây tổn thương nặng. Là phương pháp phẫu thuật thực hiện không đúng với kế hoạch phẫu thuật đã đề ra trước đó, ngoại trừ những tình huống khẩn cấp như: ", "parent_id"=>1, "content"=>"Phẫu thuật sai phương pháp (sai quy trình) gây tổn thương nặng. Là phương pháp phẫu thuật thực hiện không đúng với kế hoạch phẫu thuật đã đề ra trước đó, ngoại trừ những tình huống khẩn cấp như:"],
            ['id'=>10, "name"=>"Bỏ quên y dụng cụ, vật tư tiêu hao trong cơ thể người bệnh sau khi kết thúc phẫu thuật hoặc những thủ thuật xâm lấn khác:", "parent_id"=>1, "content"=>"Bỏ quên y dụng cụ, vật tư tiêu hao trong cơ thể người bệnh sau khi kết thúc phẫu thuật hoặc những thủ thuật xâm lấn khác:"],
            ['id'=>11, "name"=>"Tử vong xảy ra trong toàn bộ quá trình phẫu thuật (tiền mê, rạch da, đóng da) hoặc ngay sau phẫu thuật trên người bệnh có phân loại Ấ độ I.", "parent_id"=>1, "content"=>"Tử vong xảy ra trong toàn bộ quá trình phẫu thuật (tiền mê, rạch da, đóng da) hoặc ngay sau phẫu thuật trên người bệnh có phân loại Ấ độ I."],
            // lv3 parent_id =7
            ['id'=>12, "name"=>"Thay đổi vị trí phẫu thuật xảy ra quá trình phẫu thuật", "parent_id"=>7, "content"=>"Thay đổi vị trí phẫu thuật xảy ra quá trình phẫu thuật"],
            ['id'=>13, "name"=>"Sự thay đổi này được chấp thuận", "parent_id"=>7, "content"=>"Sự thay đổi này được chấp thuận"],
            // lv3 parent_id = 9
            ['id'=>14, "name"=>"Thay đổi phương pháp phẫu thuật xảy ra trong quá trình phẫu thuật", "parent_id"=>9, "content"=>"Thay đổi phương pháp phẫu thuật xảy ra trong quá trình phẫu thuật"],
            ['id'=>15, "name"=>"Sự thay đổi này được chấp thuận", "parent_id"=>9, "content"=>"Sự thay đổi này được chấp thuận"],
            // lv3 paraent_id =10
            ['id'=>16, "name"=>"Y dụng cụ đó được cấy ghép vào người bệnh (theo chỉ định)", "parent_id"=>10, "content"=>"Y dụng cụ đó được cấy ghép vào người bệnh (theo chỉ định)"],
            ['id'=>17, "name"=>"Y dụng cụ đó có trước phẫu thuật và được chú ý giữ lại", "parent_id"=>10, "content"=>"Y dụng cụ đó có trước phẫu thuật và được chú ý giữ lại"],
            ['id'=>18, "name"=>"Y dụng cụ không có trước phẫu thuật được chú ý để lại do có thể nguy hại khi lấy bỏ. Ví dụ như: những kim rất nhỏ hoặc những mảnh vỡ ốc vít.", "parent_id"=>10, "content"=>"Y dụng cụ không có trước phẫu thuật được chú ý để lại do có thể nguy hại khi lấy bỏ. Ví dụ như: những kim rất nhỏ hoặc những mảnh vỡ ốc vít."],
            // lv2 parent_id = 2
            ['id'=>19, "name"=>"Tử vong hoặc di chứng nặng liên quan tới thuốc, thiết bị hoặc sinh phẩm", "parent_id"=>2, "content"=>"Tử vong hoặc di chứng nặng liên quan tới thuốc, thiết bị hoặc sinh phẩm"],
            ['id'=>20, "name"=>"Người bệnh tử vong di chứng nghiêm trọng liên quan đến việc sử dụng hoặc liên quan đến chức năng của y dụng cụ trong quá trình chăm sóc người bệnh khác với kế hoạch đề ra ban đầu.", "parent_id"=>2, "content"=>"Người bệnh tử vong di chứng nghiêm trọng liên quan đến việc sử dụng hoặc liên quan đến chức năng của y dụng cụ trong quá trình chăm sóc người bệnh khác với kế hoạch đề ra ban đầu."],
            ['id'=>21, "name"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng liên quan đến thuyên tắc khí nội mạch trong quá trình chăm sóc, điều trị người bệnh. Ngoại trừ: Những thủ thuật ngoại thần kinh hoặc tim mạch được xác định có nguy cơ thuyên tắc khí nội mạch cao", "parent_id"=>2, "content"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng liên quan đến thuyên tắc khí nội mạch trong quá trình chăm sóc, điều trị người bệnh. Ngoại trừ: Những thủ thuật ngoại thần kinh hoặc tim mạch được xác định có nguy cơ thuyên tắc khí nội mạch cao"],
            // lv2 parent_id = 3
            ['id'=>22, "name"=>"Giao nhầm trẻ sơ sinh", "parent_id"=>3, "content"=>"Giao nhầm trẻ sơ sinh"],
            ['id'=>23, "name"=>"Người bệnh trốn viện bị tử vong hoặc bị di chứng nghiêm trọng", "parent_id"=>3, "content"=>"Người bệnh trốn viện bị tử vong hoặc bị di chứng nghiêm trọng"],
            ['id'=>24, "name"=>"Người bệnh trốn viện bị tử vong hoặc bị di chứng nghiêm trọng", "parent_id"=>3, "content"=>"Người bệnh trốn viện bị tử vong hoặc bị di chứng nghiêm trọng"],
            // lv2 parent_id = 4
            ['id'=>25, "name"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng liên quan lỗi dùng thuốc: Bao gồm: Cho một loại thuốc mà biết người bệnh có tiền sử dị ứng thuốc và tương tác thuốc có khả năng đưa đến tử vong hoặc di chứng nghiêm trọng. Ngoại trừ: Những khác biệt có lý do của việc lựa chọn thuốc và liều dùng trong xử trí lâm sàng.", "parent_id"=>4, "content"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng liên quan lỗi dùng thuốc: Bao gồm: Cho một loại thuốc mà biết người bệnh có tiền sử dị ứng thuốc và tương tác thuốc có khả năng đưa đến tử vong hoặc di chứng nghiêm trọng. Ngoại trừ: Những khác biệt có lý do của việc lựa chọn thuốc và liều dùng trong xử trí lâm sàng."],
            ['id'=>26, "name"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng liên quan đến tán huyết do truyền nhầm nhóm máu", "parent_id"=>4, "content"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng liên quan đến tán huyết do truyền nhầm nhóm máu"],
            ['id'=>27, "name"=>"Sản phụ tử vong hoặc di chứng nghiêm trọng liên quan đến quá trình chuyển dạ, sinh con: Bao gồm những sự cố xảy ra trong thời kỳ hậu sản (42 ngày sau sinh).  Ngoại trừ:", "parent_id"=>4, "content"=>"Sản phụ tử vong hoặc di chứng nghiêm trọng liên quan đến quá trình chuyển dạ, sinh con: Bao gồm những sự cố xảy ra trong thời kỳ hậu sản (42 ngày sau sinh).  Ngoại trừ:"],
            ['id'=>28, "name"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng do hạ đường huyết trong thời gian điều trị.", "parent_id"=>4, "content"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng do hạ đường huyết trong thời gian điều trị."],
            ['id'=>29, "name"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng (vàng da nhân) do tăng bilirubin máu ở trẻ sơ sinh.", "parent_id"=>4, "content"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng (vàng da nhân) do tăng bilirubin máu ở trẻ sơ sinh."],
            ['id'=>30, "name"=>"Loét do tì đè độ 3 hoặc 4 xảy ra trong lúc nằm viện", "parent_id"=>4, "content"=>"Loét do tì đè độ 3 hoặc 4 xảy ra trong lúc nằm viện"],
            ['id'=>31, "name"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng do tập vật lý trị liệu gây sang chấn chấn cột sống", "parent_id"=>4, "content"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng do tập vật lý trị liệu gây sang chấn chấn cột sống"],
            ['id'=>32, "name"=>"Nhầm lẫn trong cấy ghép mô tạng. Bao gồm nhầm lẫn tinh trùng hoặc chứng trong thụ tinh nhân tạo.", "parent_id"=>4, "content"=>"Nhầm lẫn trong cấy ghép mô tạng. Bao gồm nhầm lẫn tinh trùng hoặc chứng trong thụ tinh nhân tạo."],
            // lv3 parent_id = 26
            ['id'=>33, "name"=>"Thuyên tắc phổi hoặc thuyên tắc ối", "parent_id"=>27, "content"=>"Thuyên tắc phổi hoặc thuyên tắc ối"],
            ['id'=>34, "name"=>"Gan nhiễm mỡ cấp tính trong thai kỳ", "parent_id"=>27, "content"=>"Gan nhiễm mỡ cấp tính trong thai kỳ"],
            ['id'=>35, "name"=>"Bệnh cơ tim", "parent_id"=>27, "content"=>"Bệnh cơ tim"],
            // lv 2 parent_id = 5
            ['id'=>36, "name"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng do điện giật. Ngoại trừ: Những sự cố xảy ra do điều trị bằng điện (sốc điện phá rung hoặc chuyển nhịp bằng điện chọn lọc).", "parent_id"=>5, "content"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng do điện giật. Ngoại trừ: Những sự cố xảy ra do điều trị bằng điện (sốc điện phá rung hoặc chuyển nhịp bằng điện chọn lọc)."],
            ['id'=>37, "name"=>"Tai nạn do thiết kế đường oxy hay những loại khí khác cung cấp cho người bệnh như:", "parent_id"=>5, "content"=>"Tai nạn do thiết kế đường oxy hay những loại khí khác cung cấp cho người bệnh như:"],
            ['id'=>38, "name"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng do bỏng phát sinh do bất kỳ nguyên nhân nào khi được chăm sóc tại cơ sở.", "parent_id"=>5, "content"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng do bỏng phát sinh do bất kỳ nguyên nhân nào khi được chăm sóc tại cơ sở."],
            ['id'=>39, "name"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng do té ngã trong lúc được chăm sóc y tế tại cơ sở.", "parent_id"=>5, "content"=>"Người bệnh tử vong hoặc di chứng nghiêm trọng do té ngã trong lúc được chăm sóc y tế tại cơ sở."],
            // lv3 parent_id = 36
            ['id'=>40, "name"=>"Nhầm lẫn chất khí. Hoặc", "parent_id"=>37, "content"=>"Nhầm lẫn chất khí. Hoặc"],
            ['id'=>41, "name"=>"Chất khí lẫn độc chất", "parent_id"=>37, "content"=>"Chất khí lẫn độc chất"],
            // lv2 parent_id = 6
            ['id'=>42, "name"=>"Giả mạo nhân viên y tế để điều trị cho người bệnh", "parent_id"=>6, "content"=>"Giả mạo nhân viên y tế để điều trị cho người bệnh"],
            ['id'=>43, "name"=>"Bắt cóc (hay dụ dỗ) người bệnh ở mọi lứa tuổi", "parent_id"=>6, "content"=>"Bắt cóc (hay dụ dỗ) người bệnh ở mọi lứa tuổi"],
            ['id'=>44, "name"=>"Tấn công tình dục người bệnh trong khuôn viên bệnh viện", "parent_id"=>6, "content"=>"Tấn công tình dục người bệnh trong khuôn viên bệnh viện"],
            ['id'=>45, "name"=>"Gây tử vong hoặc thương tích nghiêm trọng cho người bệnh hoặc nhân viên y tế trong khuôn viên cơ sở khám khám bệnh, chữa bệnh.", "parent_id"=>6, "content"=>"Gây tử vong hoặc thương tích nghiêm trọng cho người bệnh hoặc nhân viên y tế trong khuôn viên cơ sở khám khám bệnh, chữa bệnh."],
            ['id'=>46, "name"=>"Gây tử vong hoặc thương tích nghiêm trọng cho người bệnh hoặc nhân viên y tế trong khuôn viên cơ sở khám khám bệnh, chữa bệnh.", "parent_id"=>6, "content"=>"Gây tử vong hoặc thương tích nghiêm trọng cho người bệnh hoặc nhân viên y tế trong khuôn viên cơ sở khám khám bệnh, chữa bệnh."]
        ]
        );
    }
}

<?php 
function UrgentReportsFormat($mang, $parent, $shilf)
{
    foreach($mang as $row)
    {
        if($row->parent_id==$parent)
        {
            echo "<div class='item-menu'><span>".$shilf.$row->name."</span><div class='category-fix'><a class='btn-category btn-primary' href='admin/category/edit/".$row->id."'><i class='fa fa-edit'></i></a><a class='btn-category btn-danger' href='admin/category/delete/".$row->id."'><i class='fa fa-close'></i></a></div></div>";
            $newParent = $row->id;
            UrgentReportsFormat($mang, $newParent,$shilf.'--|');
        }
    }
}
function UrgentFormat($mang, $parent, $shilf)
{
    // $data = [];
    foreach($mang as $key1=> $row)
    {
        if($row->parent_id==$parent)
        {
          
            // echo "<div class='item-menu'><span>".$shilf.$row->name."</span><div class='category-fix'><a class='btn-category btn-primary' href='admin/category/edit/".$row->id."'><i class='fa fa-edit'></i></a><a class='btn-category btn-danger' href='admin/category/delete/".$row->id."'><i class='fa fa-close'></i></a></div></div>";
            $newParent = $row->id;
            $data[$key1][] = [
                'id'=>$row->id,
                'name'=>$row->name,
                'parent_id'=>$row->parent_id,
                'content'=>$row->content
            ];
           
        }
        foreach($mang as $key=> $item){
            if($item['parent_id'] == $newParent){
                $data[$key1][$key]['sub'][] = [
                    'id'=>$item->id,
                    'name'=>$item->name,
                    'parent_id'=>$item->parent_id,
                    'content'=>$item->content
                ];
            }
        }
        echo "<pre>";
        print_r($data);
        UrgentFormat($mang, $newParent,$shilf.'--|');
        // return $data;
    }
    // return $data;
}

?>
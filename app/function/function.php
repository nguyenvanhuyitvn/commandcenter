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

?>
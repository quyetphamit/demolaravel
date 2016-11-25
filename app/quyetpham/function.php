<?php
/**
 * Created by PhpStorm.
 * User: phamvanquyet
 * Date: 11/22/2016
 * Time: 2:27 PM
 */
?>
<?php
function menuMulti($data)
{
    foreach ($data as $val) {
        echo '<option value ="' . $val["id"] . '">' . $val["name"] . '</option>';
    }
}

function listCate($data)
{
    $index = 0;
    foreach ($data as $val) {
        $id = $val['id'];
        echo '
         <tr class="list_data">
            <td class="aligncenter">' . ++$index . '</td>
            <td class="list_td alignleft">' . $val["name"] . '</td>
            <td class="list_td aligncenter">
                <a href="edit/' . $id . '"><img src="../../public/qt64_admin/template/images/edit.png"/></a>&nbsp;&nbsp;&nbsp;
                <a href="delete/' . $id . '" onclick = "return deleteConfirm(\'Bạn có chắc chắn muốn xóa\')"><img src="../../public/qt64_admin/template/images/delete.png"/></a>
            </td>
        </tr>
    ';
    }
}

?>

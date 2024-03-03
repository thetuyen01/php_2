<?php 
    include_once 'controller/sanpham/sanpham.php';
    $sanpham = new Sanpham();
    // thêm san pham
    if (isset($_GET['method'])&& $_GET['method']=="add"){
        if (isset($_POST['dang'])) {
            $tensp = $_POST['tensp'];
            $giasp = $_POST['giasp'];
            $mtasp = $_POST['mtasp'];
            $menu = $_POST['menu'];
            $topping = $_POST['topping'];
            $size = $_POST['size'];
            $anh = [];
            if(isset($_FILES["images"])){
                $totalFiles = count($_FILES["images"]["name"]);
            
                for($i=0; $i < $totalFiles; $i++){
                    $fileName = $_FILES["images"]["name"][$i];
                    $fileTmpName = $_FILES["images"]["tmp_name"][$i];
                    $anh[] = ['name'=>$fileName, 'tmp'=>$fileTmpName];
                }
            }
            $sanpham ->createSP($tensp, $giasp, $mtasp, $menu, $topping, $size, $anh);  
        }
        else{
            $sanpham -> showFormAdd();
        };
    // lấy danh sách menu
    }elseif(isset($_GET['method'])&& $_GET['method']=="get"){
        $sanpham->showSanpham();
        // include_once 'view/sanpham/list_products.php';
    // chỉnh sửa sanr phẩm
    }elseif(isset($_GET['method'])&& $_GET['method']=="edit"){
        if(isset($_GET['idsanpham'])){
            echo "tuyen";
            if (isset($_POST['capnhat'])){
                $tensp = $_POST['tensp'];
                $giasp = $_POST['giasp'];
                $mtasp = $_POST['mtasp'];
                $menu = $_POST['menu'];
                $topping = isset($_POST['topping'])? $_POST['topping']:null;
                $size = isset($_POST['size'])? $_POST['size']:null;
                $anh = [];
                if(isset($_FILES["images"])){
                    $totalFiles = count($_FILES["images"]["name"]);
                
                    for($i=0; $i < $totalFiles; $i++){
                        $fileName = $_FILES["images"]["name"][$i];
                        $fileTmpName = $_FILES["images"]["tmp_name"][$i];
                        $anh[] = ['name'=>$fileName, 'tmp'=>$fileTmpName];
                    }
                }    
                $sanpham ->edit_SP($tensp, $giasp, $mtasp,(int) $menu, $topping, $size, $anh, (int)$_GET['idsanpham']);
            }else{
                $sanpham -> showFormEdit((int)$_GET['idsanpham']);
            }
        }
    //xóa menu
    }elseif(isset($_GET['method'])&& $_GET['method']=="delete"&&$_GET['idsanpham']){
       $sanpham ->delete((int)$_GET['idsanpham']);
    }
?>
<?php
    $linkHomePage = URL::createLink('frontend', 'index', 'index');
    $xhtml = '';
    if(!empty($this->items)){
        $tableHeader = '<tr><td>Hình ảnh</td><td>Tên sách</td><td>Giá</td><td>Số lượng</td><td>Thành tiền</td></tr>';

        foreach($this->items as $key => $value){
            $cartID         = $value['id'];
            $date           = date('H:i:s d/m/Y', strtotime($value['date']));
            $arrBookID      = json_decode($value['books']);
            $arrPrice       = json_decode($value['prices']);
            $arrName        = json_decode($value['names']);
            $arrQuantity    = json_decode($value['quantities']);
            $arrPicture     = json_decode($value['pictures']);

            $tableContent = '';
            $totalPrice     = 0;
            foreach($arrBookID as $keyBook => $valueBook){
                //$linkBookDetail = URL::createLink('frontend', 'book', 'detail', ['book_id' => $valueBook]);
                
                $picture = HelperFrontend::createImage('book', $arrPicture[$keyBook], ['width' => '80']);

                $totalPrice += ($arrQuantity[$keyBook] * $arrPrice[$keyBook]);
                $tableContent   .= '<tr>
                    <td><a href="#">'.$picture.'</a></td>
                    <td style="min-width: 200px">'.$arrName[$keyBook].'</td>
                    <td style="min-width: 100px">'.number_format($arrPrice[$keyBook]).' đ</td>
                    <td>'.$arrQuantity[$keyBook].'</td>
                    <td style="min-width: 150px">'.number_format($arrQuantity[$keyBook] * $arrPrice[$keyBook]).' đ</td>
                </tr>';
            }

            $xhtml .= '
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button style="text-transform: none;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#'.$cartID.'">Mã đơn hàng:
                                '.$cartID.'</button>&nbsp;&nbsp;Thời gian: '.$date.'
                        </h5>
                    </div>
                    <div id="'.$cartID.'" class="collapse" data-parent="#accordionExample" style="">
                        <div class="card-body table-responsive">
                            <table class="table btn-table">
                                <thead>'.$tableHeader.'</thead>
                                <tbody>'.$tableContent.'</tbody>
                                <tfoot>
                                    <tr class="my-text-primary font-weight-bold">
                                        <td colspan="4" class="text-right">Tổng: </td>
                                        <td>'.number_format($totalPrice).' đ</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>';
        }
    }else{
        $xhtml = '<div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><button style="text-transform: none;" class="btn btn-link collapsed">Chưa có đơn hàng nào!
                        Click vào <a href="'.$linkHomePage.'">đây</a> để trở về trang chủ!</h5>
                    </div>
                </div>';
    }
?>

<?php echo HelperFrontend::createTitle('Lịch sử mua hàng') ?>

<section class="faq-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="account-sidebar">
                    <a class="popup-btn">Menu</a>
                </div>
                <h3 class="d-lg-none">Lịch sử mua hàng</h3>
                <div class="dashboard-left">
                    <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> Ẩn</span></div>
                    <div class="block-content">
                        <ul>
                            <?php require_once 'elements/menu.php' ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="accordion theme-accordion" id="accordionExample">
                    <div class="accordion theme-accordion" id="accordionExample">
                        <?php echo $xhtml ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
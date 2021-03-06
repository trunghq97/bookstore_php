<?php
    $linkHomePage   = URL::createLink('frontend', 'index', 'index');
    $linkSubmitForm = URL::createLink('frontend', 'user', 'buy');

    $totalPrice = 0;
    if(!empty($this->items)){
        $xhtml = '';
        
        foreach($this->items as $key => $item){
            $bookName   = $item['name'];
            $bookPrice  = $item['price'];
            $priceTotal = $item['total_price'];
            $linkBook   = URL::createLink('frontend', 'book', 'detail', ['book_id' => $item['id']]);
            $quantity   = $item['quantity'];
            $totalPrice += $priceTotal;
            $picturePath        = PATH_UPLOAD . 'book' . DS . $item['picture']; 
            if(file_exists($picturePath) && (!empty($item['picture']))){
                $picture        = URL_UPLOAD . 'book' . DS . $item['picture'];
            }else{
                $picture        = URL_UPLOAD . 'book' . DS . 'default-picture.jpg';
            }

            $inputBookID    = Form::cmsInput('hidden', 'form[book_id][]', 'input_book_id_' . $item['id'], $item['id']);
            $inputQuantity  = Form::cmsInput('hidden', 'form[quantity][]', 'input_quantity_' . $item['id'], $item['quantity']);
            $inputPrice     = Form::cmsInput('hidden', 'form[price][]', 'input_price_' . $item['id'], $item['price']);
            $inputName      = Form::cmsInput('hidden', 'form[name][]', 'input_name_' . $item['id'], $item['name']);
            $inputPicture   = Form::cmsInput('hidden', 'form[picture][]', 'input_picture_' . $item['id'], $item['picture']);

            $xhtml .= '
                <tr>
                    <td><a href="'.$linkBook.'"><img src="'.$picture.'" alt="'.$bookName.'"></a></td>
                    <td><a href="'.$linkBook.'">'.$bookName.'</a>
                        <div class="mobile-cart-content row">
                            <div class="col-xs-3">
                                <div class="qty-box">
                                    <div class="input-group">
                                        <input type="number" name="quantity" value="1" class="form-control input-number" id="quantity-10" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <h2 class="td-color text-lowercase">48,300 ??</h2>
                            </div>
                            <div class="col-xs-3">
                                <h2 class="td-color text-lowercase">
                                    <a href="#" class="icon"><i class="ti-close"></i></a>
                                </h2>
                            </div>
                        </div>
                    </td>
                    <td>
                        <h2 class="text-lowercase">' . number_format($bookPrice) . ' ??</h2>
                    </td>
                    <td>
                        <div class="qty-box">
                            <div class="input-group">
                                <input type="number" name="quantity" value="'.$quantity.'" class="form-control input-number" id="quantity-10" min="1">
                            </div>
                        </div>
                    </td>
                    <td><a href="#" class="icon"><i class="ti-close"></i></a></td>
                    <td>
                        <h2 class="td-color text-lowercase">' . number_format($priceTotal) . ' ??</h2>
                    </td>
                </tr>';
            $xhtml .= $inputBookID . $inputQuantity . $inputPrice . $inputName . $inputPicture;
        }
    }else{
        $xhtml = '
            <section class="cart-section section-b-space">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12 text-center">
                                <i class="fa fa-cart-plus fa-5x my-text-primary"></i>
                                <h5 class="my-3">Kh??ng c?? s???n ph???m n??o trong gi??? h??ng c???a b???n</h5>
                                <a href="'.$linkHomePage.'" class="btn btn-solid">Ti???p t???c mua s???m</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>';
    }
?>

<?php echo HelperFrontend::createTitle('Gi??? h??ng') ?>

<?php
    if(!empty($this->items)){
?>    
        <form action="<?php echo $linkSubmitForm ?>" method="POST" name="admin-form" id="admin-form">
            <section class="cart-section section-b-space">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table cart-table table-responsive-xs">
                                <thead>
                                    <tr class="table-head">
                                        <th scope="col">H??nh ???nh</th>
                                        <th scope="col">T??n s??ch</th>
                                        <th scope="col">Gi??</th>
                                        <th scope="col">S??? L?????ng</th>
                                        <th scope="col"></th>
                                        <th scope="col">Th??nh ti???n</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo $xhtml; ?>
                                </tbody>
                            </table>
                            <table class="table cart-table table-responsive-md">
                                <tfoot>
                                    <tr>
                                        <td>T???ng :</td>
                                        <td>
                                            <h2 class="text-lowercase"><?php echo number_format($totalPrice) ?> ??</h2>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row cart-buttons">
                        <div class="col-6"><a href="<?php echo $linkHomePage ?>" class="btn btn-solid">Ti???p t???c mua s???m</a></div>
                        <div class="col-6"><button type="submit" class="btn btn-solid">?????t h??ng</button></div>
                    </div>
                </div>
            </section>
        </form>
<?php
    }else{
        echo $xhtml;
    }
?>
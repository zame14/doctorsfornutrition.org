<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/12/2022
 * Time: 11:09 AM
 */
defined( 'ABSPATH' ) || exit;
get_header('print');
global $post;
$page = '';
if(isset($_REQUEST['print_id']) && $_REQUEST['print_id'] <> "")
{
    $page = new Page($_REQUEST['print_id']);
}
?>
<div class="wrapper" id="page-print">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="print-page-title">
                    <h1><?=$page->getTitle()?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="print-content" class="container">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?=$page->getContent(true)?>
            </div>
        </div>
    </div>
</div>

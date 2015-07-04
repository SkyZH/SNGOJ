<?php
require_once("./include/const.php");
require_once(OJ_ROOT."/template/page_start.php"); ?>

<section>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Status</div>
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="4">

                            <form method="get" action="status.php" role="form">
                                <div class="row">

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Problem ID" name="pid">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Problem ID" name="pid">
                                        </div>                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Problem ID" name="pid">
                                        </div>                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Problem ID" name="pid">
                                        </div>                                    </div>
                                    <div class="col-lg-1">
                                        <button class="btn btn-default" type="submit">
                                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $("#_nav_discuss").addClass("active");
    })
</script>
<?php require_once(OJ_ROOT."/template/page_end.php"); ?>

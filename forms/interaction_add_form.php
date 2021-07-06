<?php
include_once ("../php_functions/functions.php");
include_once ("../configs/conn.inc");
?>



            <form class="form-horizontal" autocomplete="off" onsubmit="return false;" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="customer" class="col-sm-3 control-label">Customer</label>

                        <div class="col-sm-9">
                            <input class="form-control" type="text" autocomplete="off" onkeyup="search_cust();" id="customer_search" placeholder="Start typing customer name ...">
                            <input type="hidden" id="customer_id_">
                            <div id="customer_results">

                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="details" class="col-sm-3 control-label">Details</label>

                        <div class="col-sm-9">
                            <textarea class="form-control" id="details"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="conversation_method" class="col-sm-3 control-label">Conversation Method</label>

                        <div class="col-sm-9">
                            <?php
                            $o_conversation_methods_ = fetchtable('o_conversation_methods',"status=1", "uid", "desc", "0,10", "uid ,name , details,status ");
                            while($n = mysqli_fetch_array($o_conversation_methods_))
                            {
                                $uid = $n['uid'];
                                $name = $n['name'];
                                $status = $n['status'];
                                $details = $n['details'];

                                echo "<label class='radio-box'><i class='fa $details'></i> <input type=\"radio\"  name=\"conversation_method\" value=\"$uid\"> $name</label>";
                            }
                            ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="conversation_method" class="col-sm-3 control-label">Flag</label>

                        <div class="col-sm-9">
                            <?php
                            $o_flags_ = fetchtable('o_flags',"uid>0", "uid", "desc", "0,10", "uid ,name ,description ,color_code ");
                            while($n = mysqli_fetch_array($o_flags_))
                            {
                                $uid = $n['uid'];
                                $name = $n['name'];
                                $description = $n['description'];
                                $color_code = $n['color_code'];

                                echo "<label class='radio-box'><i class='fa fa-flag' style='color: $color_code;'></i> <input type=\"radio\" name=\"flag\" value=\"$uid\">  $name</label>";
                            }
                            ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="next_int" class="col-sm-3 control-label">Next Interaction</label>

                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="next_int">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="next_stage" class="col-sm-3 control-label">Next Steps</label>

                        <div class="col-sm-9">
                            <select class="form-control" id="next_stage">
                                <option value="0">--Select One</option>
                            <?php
                            $o_next_steps_ = fetchtable('o_next_steps',"uid>0", "uid", "desc", "0,10", "uid ,name ,details ");
                            while($a = mysqli_fetch_array($o_next_steps_))
                            {
                                $uid = $a['uid'];
                                $name = $a['name'];
                                $details = $a['details'];
                                echo "<option value='$uid'>$name</option>";
                            }

                            ?>
                            </select>

                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <div class="box-footer">
                            <br/>
                            <button type="submit" class="btn btn-lg btn-default">Cancel</button>
                            <button type="submit"
                                    class="btn btn-success bg-green-gradient btn-lg pull-right"
                                    onclick="save_interaction('<?php echo $sid; ?>');">
                                Save
                            </button>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->

                <!-- /.box-footer -->
            </form>

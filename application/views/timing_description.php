<?php  include('header_client.php');

        
        $business_id = $_REQUEST['edit_gallery'];

		$categoryid = $_REQUEST['category_id'];

		$subcatid = $_REQUEST['sub_cat_id'];

		$subsubcatid = $_REQUEST['subsubcat_id'];

    	$adminid = $this->session->userdata('id');

		// $res_timing_description_business = $this->db->query("select * from timing_business where category_id='$categoryid' and subcategory_id='$subcatid' and sub_sub_categoryid='$subsubcatid' and admin_id='$adminid'");

		$res_timing_description_business = $this->db->query("select * from timing_business where admin_id='$adminid'");

		$row_timing_description_business = $res_timing_description_business->result();

		$description = @$row_timing_description_business['0']->description;

		$timing_data = array();

		$timing_data = @$row_timing_description_business['0']->timing_json_array;



		// $timing_data_decode = json_decode($timing_data);

		// print_r($timing_data);

	

		

 ?>



<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<script type="text/javascript"

src="//cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.2.17/jquery.timepicker.min.js"></script>

<link rel="stylesheet" type="text/css"

href="//cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.2.17/jquery.timepicker.min.css"/>

<script src="//cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js" type="text/javascript"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.js" type="text/javascript"></script>

<!-- <script type="text/javascript" src="<?php // echo base_url(); ?>/public/js/jquery.businessHours.min.js"></script> -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/jquery.businessHours.css"/>

<section class="vbox">          

	<section class="scrollable padder wrapper">            

		<div class="row">

			<form action="<?php echo base_url().'index.php/client_menu/timing_description_insert/';  ?>" data-validate="parsley" enctype="multipart/form-data" method="post">

				<div class="col-sm-12">

					<header class="panel-heading form_panel">

						<span class="h4">ADD/EDIT Timing and Description to your Business</span>

					</header>

					<div id="container" class="col-md-12">

						<div class=" col-md-6">

							<section class="panel panel-default">

								<div class="panel-body">

									<div class="form-group">

										<div id="businessHoursContainer3"></div>

										<textarea id="businessHoursOutput1" style="display:none;" name="hide" class="form-group no_mrgn" rows="8" cols="80"></textarea>                     

									</div>

								</div>

								<div class="modal-footer">

                                   <button id="btnSerialize" type="button" class="btn btn-success">Generate Timing Slots</button>

                                </div>

							</section>

						</div>

						<div>   

                            <input type="hidden" name="category_id" value="<?php echo $categoryid; ?>" />

                            <input type="hidden" name="business_id" value="<?php echo $business_id; ?>" />

                             <input type="hidden" name="sub_cat_id" value="<?php echo $subcatid; ?>" />

                              <input type="hidden" name="sub_sub_cat_id" value="<?php echo $subsubcatid; ?>" />

                        </div>

						<div class=" col-md-6">

							<section class="panel panel-default ">

								<div class="panel-body brdr_btm">

									<div class="form-group">

										<textarea id="" name="description" class="form-group no_mrgn" rows="8" cols="80"><?php echo htmlspecialchars($description); ?></textarea>

									</div>

								</div>

							

							<footer class="panel-footer text-right bg-light lter">

                    <button type="submit" class="btn btn-success btn-s-xs">Submit</button>

                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="mycancel"

                         class="modal fade bs-example-modal-sm">

                        <div class="modal-dialog modal-sm">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                    <h4 class="modal-title"><i class="fa fa-building-o"></i> Plan Insert Master Alert </h4>

                                </div>

                                <div class="modal-body">

                                    <i class="fa fa-question-circle"></i> Are You Sure To Go Back!

                                </div>

                                <div class="modal-footer">

                                    <input type='button' value='Yes' class="btn btn-success btn-shadow" onclick=""/>

                                    <button data-dismiss="modal" class="btn btn-danger btn-shadow" type="button">No</button>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- End Code for Cancle Alert-->

                    <a href="" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>

                </footer></section>

						</div>

					</div>

					

			</form>

		</div>

		</section>

	</section>



	<?php 





	?>

	<script type="text/javascript">

		/**

 jquery.businessHours v1.0.1

 https://github.com/gEndelf/jquery.businessHours



 requirements:

 - jQuery 1.7+



 recommended time-picker:

 - jquery-timepicker 1.2.7+ // https://github.com/jonthornton/jquery-timepicker

 **/



(function($) {

    $.fn.businessHours = function(opts) {

        var defaults = {

            preInit: function() {

            },

            postInit: function() {

            },

            inputDisabled: false,

            checkedColorClass: "WorkingDayState",

            uncheckedColorClass: "RestDayState",

            colorBoxValContainerClass: "colorBoxContainer",

            weekdays: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],

            operationTime: [

                {isActive: true},

                {isActive: false},

                {isActive: false},

                {isActive: false},

                {isActive: false},

                {isActive: false},

                {isActive: false}

                

            ],

            defaultOperationTimeFrom: '11:30',

            defaultOperationTimeTill: '18:00',

            defaultActive: true,

            //labelOn: "Working day",

            //labelOff: "Day off",

            //labelTimeFrom: "from:",

            //labelTimeTill: "till:",

            containerTmpl: '<div class="clean"/>',

            dayTmpl: '<div class="dayContainer">' +

            '<div data-original-title="" class="colorBox"><input type="checkbox" class="invisible operationState"/></div>' +

            '<div class="weekday"></div>' +

            '<div class="operationDayTimeContainer">' +

            '<div class="operationTime"><input type="text" name="startTime" class="mini-time operationTimeFrom" value=""/></div>' +

            '<div class="operationTime"><input type="text" name="endTime" class="mini-time operationTimeTill" value=""/></div>' +

            '</div></div>'

        };



        var container = $(this);



        function initTimeBox(timeBoxSelector, time, isInputDisabled) {

            timeBoxSelector.val(time);



            if(isInputDisabled) {

                timeBoxSelector.prop('readonly', true);

            }

        }



        var methods = {

            getValueOrDefault: function(val, defaultVal) {

                return (jQuery.type(val) === "undefined" || val == null) ? defaultVal : val;

            },

            init: function(opts) {

                this.options = $.extend(defaults, opts);

                container.html("");



                if(typeof this.options.preInit === "function") {

                    this.options.preInit();

                }



                this.initView(this.options);



                if(typeof this.options.postInit === "function") {

                    //$('.operationTimeFrom, .operationTimeTill').timepicker(options.timepickerOptions);

                    this.options.postInit();

                }



                return {

                    serialize: function() {

                        var data = [];



                        container.find(".operationState").each(function(num, item) {

                            var isWorkingDay = $(item).prop("checked");

                            var dayContainer = $(item).parents(".dayContainer");



                            data.push({

                                isActive: isWorkingDay,

                                timeFrom: isWorkingDay ? dayContainer.find("[name='startTime']").val() : null,

                                timeTill: isWorkingDay ? dayContainer.find("[name='endTime']").val() : null

                            });

                        });



                        return data;

                    }

                };

            },

            initView: function(options) {

                var stateClasses = [options.checkedColorClass, options.uncheckedColorClass];

                var subContainer = container.append($(options.containerTmpl));

                var $this = this;



                for(var i = 0; i < options.weekdays.length; i++) {

                    subContainer.append(options.dayTmpl);

                }



                $.each(options.weekdays, function(pos, weekday) {

                    // populate form

                    var day = options.operationTime[pos];

                    var operationDayNode = container.find(".dayContainer").eq(pos);

                    operationDayNode.find('.weekday').html(weekday);



                    var isWorkingDay = $this.getValueOrDefault(day.isActive, options.defaultActive);

                    operationDayNode.find('.operationState').prop('checked', isWorkingDay);



                    var timeFrom = $this.getValueOrDefault(day.timeFrom, options.defaultOperationTimeFrom);

                    initTimeBox(operationDayNode.find('[name="startTime"]'), timeFrom, options.inputDisabled);



                    var endTime = $this.getValueOrDefault(day.timeTill, options.defaultOperationTimeTill);

                    initTimeBox(operationDayNode.find('[name="endTime"]'), endTime, options.inputDisabled);

                });



                container.find(".operationState").change(function() {

                    var checkbox = $(this);

                    var boxClass = options.checkedColorClass;

                    var timeControlDisabled = false;



                    if(!checkbox.prop("checked")) {

                        // disabled

                        boxClass = options.uncheckedColorClass;

                        timeControlDisabled = true;

                    }



                    checkbox.parents(".colorBox").removeClass(stateClasses.join(' ')).addClass(boxClass);

                    checkbox.parents(".dayContainer").find(".operationTime").toggle(!timeControlDisabled);

                }).trigger("change");



                if(!options.inputDisabled) {

                    container.find(".colorBox").on("click", function() {

                        var checkbox = $(this).find(".operationState");

                        checkbox.prop("checked", !checkbox.prop('checked')).trigger("change");

                    });

                }

            }

        };



        return methods.init(opts);

    };

})(jQuery);

	</script>

	<script type="text/javascript">

		var businessHoursManager = $("#businessHoursContainer3").businessHours();

		$("#btnSerialize").click(function() {

			$("textarea#businessHoursOutput1").val(JSON.stringify(businessHoursManager.serialize()));

			alert('Timing Slots are generated please Add Features of your Business');

		});

	</script>

	<script>

		(function () {

			Rainbow.color();



			var b3 = $("#businessHoursContainer3");

			var businessHoursManagerBootstrap = b3.businessHours({

				postInit: function () {

					b3.find('.operationTimeFrom, .operationTimeTill').timepicker({

						'timeFormat': 'H:i',

						'step': 30

					});

				},

				dayTmpl: '<div class="dayContainer" style="width: 80px;">' +

				'<div data-original-title="" class="colorBox"><input type="checkbox" class="invisible operationState"/></div>' +

				'<div class="weekday"></div>' +

				'<div class="operationDayTimeContainer">' +

				'<div class="operationTime input-group">' +

				'<span class="input-group-addon">' +

				'<i class="fa fa-sun-o"></i>' +

				'</span>' +

				'<input type="text" name="startTime" class="mini-time form-control operationTimeFrom" value=""/></div>' +

				'<div class="operationTime input-group">' +

				'<span class="input-group-addon"><i class="fa fa-moon-o"></i></span><input type="text" name="endTime" class="mini-time form-control operationTimeTill" value=""/></div>' +

				'</div></div>'

			});

		})();

	</script>

	<?php  include('footer_client.php'); ?>
<!--<script src="<?php echo base_url() ?>assets-ds/select-master/dist/js/standalone/selectize.js"></script>
<style>
    .welcome-page{
        background-image: url('<?php echo base_url() ?>assets-ds/bg.jpg');
        background-repeat: no-repeat;
        background-position: center center;
        /*background-attachment: fixed;*/   
        background-size: 100% auto;
    }
</style>

<div class="row">
					<div class="col-lg-3 col-xs-12">
						<div class="panel panel-default card-view  pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body  pa-0">
									<div class="profile-box">
										<div class="profile-cover-pic">
											<div class="fileupload btn btn-default">
												<span class="btn-text">edit</span>
												<input class="upload" type="file">
											</div>
											<div class="profile-image-overlay"></div>
										</div>
										<div class="profile-info text-center">
											<div class="profile-img-wrap">
												<img class="inline-block mb-10" src="../img/mock1.jpg" alt="user"/>
												<div class="fileupload btn btn-default">
													<span class="btn-text">edit</span>
													<input class="upload" type="file">
												</div>
											</div>	
											<h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-info">Madalyn Rascon</h5>
											<h6 class="block capitalize-font pb-20">Developer Geek</h6>
										</div>	
										<div class="social-info">
											<div class="row">
												<div class="col-xs-4 text-center">
													<span class="counts block head-font"><span class="counter-anim">345</span></span>
													<span class="counts-text block">post</span>
												</div>
												<div class="col-xs-4 text-center">
													<span class="counts block head-font"><span class="counter-anim">246</span></span>
													<span class="counts-text block">followers</span>
												</div>
												<div class="col-xs-4 text-center">
													<span class="counts block head-font"><span class="counter-anim">898</span></span>
													<span class="counts-text block">tweets</span>
												</div>
											</div>
											<button class="btn btn-info btn-block  btn-anim mt-30" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i><span class="btn-text">edit profile</span></button>
											<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h5 class="modal-title" id="myModalLabel">Edit Profile</h5>
														</div>
														<div class="modal-body">
															 Row 
															<div class="row">
																<div class="col-lg-12">
																	<div class="">
																		<div class="panel-wrapper collapse in">
																			<div class="panel-body pa-0">
																				<div class="col-sm-12 col-xs-12">
																					<div class="form-wrap">
																						<form action="#">
																							<div class="form-body overflow-hide">
																								<div class="form-group">
																									<label class="control-label mb-10" for="exampleInputuname_1">Name</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-user"></i></div>
																										<input type="text" class="form-control" id="exampleInputuname_1" placeholder="willard bryant">
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10" for="exampleInputEmail_1">Email address</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																										<input type="email" class="form-control" id="exampleInputEmail_1" placeholder="xyz@gmail.com">
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10" for="exampleInputContact_1">Contact number</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-phone"></i></div>
																										<input type="email" class="form-control" id="exampleInputContact_1" placeholder="+102 9388333">
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10" for="exampleInputpwd_1">Password</label>
																									<div class="input-group">
																										<div class="input-group-addon"><i class="icon-lock"></i></div>
																										<input type="password" class="form-control" id="exampleInputpwd_1" placeholder="Enter pwd" value="password">
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10">Gender</label>
																									<div>
																										<div class="radio">
																											<input type="radio" name="radio1" id="radio_1" value="option1" checked="">
																											<label for="radio_1">
																											M
																											</label>
																										</div>
																										<div class="radio">
																											<input type="radio" name="radio1" id="radio_2" value="option2">
																											<label for="radio_2">
																											F
																											</label>
																										</div>
																									</div>
																								</div>
																								<div class="form-group">
																									<label class="control-label mb-10">Country</label>
																									<select class="form-control" data-placeholder="Choose a Category" tabindex="1">
																										<option value="Category 1">USA</option>
																										<option value="Category 2">Austrailia</option>
																										<option value="Category 3">India</option>
																										<option value="Category 4">UK</option>
																									</select>
																								</div>
																							</div>
																							<div class="form-actions mt-10">			
																								<button type="submit" class="btn btn-success mr-10 mb-30">Update profile</button>
																							</div>				
																						</form>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Save</button>
															<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
														</div>
													</div>
													 /.modal-content 
												</div>
												 /.modal-dialog 
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div  class="panel-body pb-0">
									<div  class="tab-struct custom-tab-1">
										<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
											<li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>profile</span></a></li>
											<li  role="presentation" class="next"><a aria-expanded="true"  data-toggle="tab" role="tab" id="follo_tab_8" href="#follo_8"><span>followers<span class="inline-block">(246)</span></span></a></li>
											<li role="presentation" class=""><a  data-toggle="tab" id="photos_tab_8" role="tab" href="#photos_8" aria-expanded="false"><span>photos</span></a></li>
											<li role="presentation" class=""><a  data-toggle="tab" id="earning_tab_8" role="tab" href="#earnings_8" aria-expanded="false"><span>earnings</span></a></li>
											<li role="presentation" class=""><a  data-toggle="tab" id="settings_tab_8" role="tab" href="#settings_8" aria-expanded="false"><span>settings</span></a></li>
											<li class="dropdown" role="presentation">
												<a  data-toggle="dropdown" class="dropdown-toggle" id="myTabDrop_7" href="#" aria-expanded="false"><span>More</span> <span class="caret"></span></a>
												<ul id="myTabDrop_7_contents"  class="dropdown-menu">
													<li class=""><a  data-toggle="tab" id="dropdown_13_tab" role="tab" href="#dropdown_13" aria-expanded="true">About</a></li>
													<li class=""><a  data-toggle="tab" id="dropdown_14_tab" role="tab" href="#dropdown_14" aria-expanded="false">Followings</a></li>
													<li class=""><a  data-toggle="tab" id="dropdown_15_tab" role="tab" href="#dropdown_15" aria-expanded="false">Likes</a></li>
													<li class=""><a  data-toggle="tab" id="dropdown_16_tab" role="tab" href="#dropdown_16" aria-expanded="false">Reviews</a></li>
												</ul>
											</li>
										</ul>
										<div class="tab-content" id="myTabContent_8">
											<div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
												<div class="col-md-12">
													<div class="pt-20">
														<div class="streamline user-activity">
															<div class="sl-item">
																<a href="javascript:void(0)">
																	<div class="sl-avatar avatar avatar-sm avatar-circle">
																		<img class="img-responsive img-circle" src="../img/user.png" alt="avatar"/>
																	</div>
																	<div class="sl-content">
																		<p class="inline-block"><span class="capitalize-font txt-success mr-5 weight-500">Clay Masse</span><span>invited to join the meeting in the conference room at 9.45 am</span></p>
																		<span class="block txt-grey font-12 capitalize-font">3 Min</span>
																	</div>
																</a>
															</div>

															<div class="sl-item">
																<a href="javascript:void(0)">
																	<div class="sl-avatar avatar avatar-sm avatar-circle">
																		<img class="img-responsive img-circle" src="../img/user1.png" alt="avatar"/>
																	</div>
																	<div class="sl-content">
																		<p class="inline-block"><span class="capitalize-font txt-success mr-5 weight-500">Evie Ono</span><span>added three new photos in the library</span></p>
																		<div class="activity-thumbnail">
																			<img src="../img/thumb-1.jpg" alt="thumbnail"/>
																			<img src="../img/thumb-2.jpg" alt="thumbnail"/>
																			<img src="../img/thumb-3.jpg" alt="thumbnail"/>
																		</div>
																		<span class="block txt-grey font-12 capitalize-font">8 Min</span>
																	</div>
																</a>	
															</div>

															<div class="sl-item">
																<a href="javascript:void(0)">
																	<div class="sl-avatar avatar avatar-sm avatar-circle">
																		<img class="img-responsive img-circle" src="../img/user2.png" alt="avatar"/>
																	</div>
																	<div class="sl-content">
																		<p class="inline-block"><span class="capitalize-font txt-success mr-5 weight-500">madalyn rascon</span><span>assigned a new task</span></p>
																		<span class="block txt-grey font-12 capitalize-font">28 Min</span>
																	</div>
																</a>	
															</div>

															<div class="sl-item">
																<a href="javascript:void(0)">
																	<div class="sl-avatar avatar avatar-sm avatar-circle">
																		<img class="img-responsive img-circle" src="../img/user3.png" alt="avatar"/>
																	</div>
																	<div class="sl-content">
																		<p class="inline-block"><span class="capitalize-font txt-success mr-5 weight-500">Ezequiel Merideth</span><span>completed project wireframes</span></p>
																		<span class="block txt-grey font-12 capitalize-font">yesterday</span>
																	</div>
																</a>	
															</div>
															
															<div class="sl-item">
																<a href="javascript:void(0)">
																	<div class="sl-avatar avatar avatar-sm avatar-circle">
																		<img class="img-responsive img-circle" src="../img/user4.png" alt="avatar"/>
																	</div>
																	<div class="sl-content">
																		<p class="inline-block"><span class="capitalize-font txt-success mr-5 weight-500">jonnie metoyer</span><span>created a group 'Hencework' in the discussion forum</span></p>
																		<span class="block txt-grey font-12 capitalize-font">18 feb</span>
																	</div>
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
											
											<div  id="follo_8" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-lg-12">
														<div class="followers-wrap">
															<ul class="followers-list-wrap">
																<li class="follow-list">
																	<div class="follo-body">
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Clay Masse</span>
																				<span class="time block truncate txt-grey">No one saves us but ourselves.</span>
																			</div>
																			<button class="btn btn-success pull-right btn-xs fixed-btn">Follow</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user1.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Evie Ono</span>
																				<span class="time block truncate txt-grey">Unity is strength</span>
																			</div>
																			<button class="btn btn-success btn-outline pull-right btn-xs fixed-btn">following</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user2.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Madalyn Rascon</span>
																				<span class="time block truncate txt-grey">Respect yourself if you would have others respect you.</span>
																			</div>
																			<button class="btn btn-success btn-outline pull-right btn-xs fixed-btn">following</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user3.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Mitsuko Heid</span>
																				<span class="time block truncate txt-grey">I’m thankful.</span>
																			</div>
																			<button class="btn btn-success pull-right btn-xs fixed-btn">Follow</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Ezequiel Merideth</span>
																				<span class="time block truncate txt-grey">Patience is bitter.</span>
																			</div>
																			<button class="btn btn-success pull-right btn-xs fixed-btn">Follow</button>
																			<div class="clearfix"></div>
																		</div>
																		<div class="follo-data">
																			<img class="user-img img-circle"  src="../img/user1.png" alt="user"/>
																			<div class="user-data">
																				<span class="name block capitalize-font">Jonnie Metoyer</span>
																				<span class="time block truncate txt-grey">Genius is eternal patience.</span>
																			</div>
																			<button class="btn btn-success btn-outline pull-right btn-xs fixed-btn">following</button>
																			<div class="clearfix"></div>
																		</div>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
											<div  id="photos_8" class="tab-pane fade" role="tabpanel">
												<div class="col-md-12 pb-20">
													<div class="gallery-wrap">
														<div class="portfolio-wrap project-gallery">
															<ul id="portfolio_1" class="portf auto-construct  project-gallery" data-col="4">
																<li  class="item"   data-src="../img/gallery/equal-size/mock1.jpg" data-sub-html="<h6>Bagwati</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" >
																	<a href="#">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock1.jpg"  alt="Image description" />
																	<span class="hover-cap">Bagwati</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock2.jpg"   data-sub-html="<h6>Not a Keyboard</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="#">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock2.jpg"  alt="Image description" />
																	<span class="hover-cap">Not a Keyboard</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock3.jpg" data-sub-html="<h6>Into the Woods</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="#">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock3.jpg"  alt="Image description" />
																	<span class="hover-cap">Into the Woods</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock4.jpg"  data-sub-html="<h6>Ultra Saffire</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="#">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock4.jpg"  alt="Image description" />
																	<span class="hover-cap"> Ultra Saffire</span>
																	</a>
																</li>
																
																<li class="item" data-src="../img/gallery/equal-size/mock5.jpg" data-sub-html="<h6>Happy Puppy</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="#">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock5.jpg"  alt="Image description" />	
																	<span class="hover-cap">Happy Puppy</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock6.jpg"  data-sub-html="<h6>Wooden Closet</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="#">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock6.jpg"  alt="Image description" />
																	<span class="hover-cap">Wooden Closet</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock7.jpg" data-sub-html="<h6>Happy Puppy</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="#">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock7.jpg"  alt="Image description" />	
																	<span class="hover-cap">Happy Puppy</span>
																	</a>
																</li>
																<li class="item" data-src="../img/gallery/equal-size/mock8.jpg"  data-sub-html="<h6>Wooden Closet</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																	<a href="#">
																	<img class="img-responsive" src="../img/gallery/equal-size/mock8.jpg"  alt="Image description" />
																	<span class="hover-cap">Wooden Closet</span>
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</div>	
											</div>
											<div  id="earnings_8" class="tab-pane fade" role="tabpanel">
												 Row 
												<div class="row">
													<div class="col-lg-12">
														<form id="example-advanced-form" action="#">
															<div class="table-wrap">
																<div class="table-responsive">
																	<table class="table table-striped display product-overview" id="datable_1">
																		<thead>
																			<tr>
																				<th>Date</th>
																				<th>Item Sales Colunt</th>
																				<th>Earnings</th>
																			</tr>
																		</thead>
																		<tfoot>
																			<tr>
																				<th colspan="2">total:</th>
																				<th></th>
																			</tr>
																		</tfoot>
																		<tbody>
																			<tr>
																				<td>monday, 12</td>
																				<td>
																				 3
																				</td>
																				<td>$400</td>
																			</tr>
																			<tr>
																				<td>tuesday, 13</td>
																				<td>
																				 2
																				</td>
																				<td>$400</td>
																			</tr>
																			<tr>
																				<td>wednesday, 14</td>
																				<td>
																				 3
																				</td>
																				<td>$420</td>
																			</tr>
																			<tr>
																				<td>thursday, 15</td>
																				<td>
																				 5
																				</td>
																				<td>$500</td>
																			</tr>
																			<tr>
																				<td>friday, 15</td>
																				<td>
																				 3
																				</td>
																				<td>$400</td>
																			</tr>
																			<tr>
																				<td>saturday, 16</td>
																				<td>
																				 3
																				</td>
																				<td>$400</td>
																			</tr>
																			<tr>
																				<td>sunday, 17</td>
																				<td>
																				 3
																				</td>
																				<td>$400</td>
																			</tr>
																			<tr>
																				<td>monday, 18</td>
																				<td>
																				 3
																				</td>
																				<td>$500</td>
																			</tr>
																			<tr>
																				<td>tuesday, 19</td>
																				<td>
																				 3
																				</td>
																				<td>$400</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div  id="settings_8" class="tab-pane fade" role="tabpanel">
												 Row 
												<div class="row">
													<div class="col-lg-12">
														<div class="">
															<div class="panel-wrapper collapse in">
																<div class="panel-body pa-0">
																	<div class="col-sm-12 col-xs-12">
																		<div class="form-wrap">
																			<form action="#">
																				<div class="form-body overflow-hide">
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputuname_01">Name</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-user"></i></div>
																							<input type="text" class="form-control" id="exampleInputuname_01" placeholder="willard bryant">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputEmail_01">Email address</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																							<input type="email" class="form-control" id="exampleInputEmail_01" placeholder="xyz@gmail.com">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputContact_01">Contact number</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-phone"></i></div>
																							<input type="email" class="form-control" id="exampleInputContact_01" placeholder="+102 9388333">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10" for="exampleInputpwd_01">Password</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-lock"></i></div>
																							<input type="password" class="form-control" id="exampleInputpwd_01" placeholder="Enter pwd" value="password">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10">Gender</label>
																						<div>
																							<div class="radio">
																								<input type="radio" name="radio1" id="radio_01" value="option1" checked="">
																								<label for="radio_01">
																								M
																								</label>
																							</div>
																							<div class="radio">
																								<input type="radio" name="radio1" id="radio_02" value="option2">
																								<label for="radio_02">
																								F
																								</label>
																							</div>
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="control-label mb-10">Country</label>
																						<select class="form-control" data-placeholder="Choose a Category" tabindex="1">
																							<option value="Category 1">USA</option>
																							<option value="Category 2">Austrailia</option>
																							<option value="Category 3">India</option>
																							<option value="Category 4">UK</option>
																						</select>
																					</div>
																				</div>
																				<div class="form-actions mt-10">			
																					<button type="submit" class="btn btn-success mr-10 mb-30">Update profile</button>
																				</div>				
																			</form>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
							
					</div>
				</div>

<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-7" >
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-left">
                    <ol class="breadcrumb">
                        <li class="active"><a href="<?php echo base_url(); ?>dashboard"><i class='fa fa-home mg-r-sm'></i>Dashboard</a></li>
                        <li class="active">My Profile</li>
                    </ol>
                </div>
            </div>
            <div class="row"> 
                <div id="loader"></div>
                <div id="message"></div>
                <div id="forms">
                    <div class="col-md-12 mg-b-md">
                        <section class="panel no-border  position-relative ">
                            <div class="ribbon ribbon-danger">
                                <div class="banner">
                                    <div class="text"><?php echo strtoupper($this->config->item("config_app_name")); ?></div>
                                </div>
                            </div>
                            <div class="panel-body welcome-page" style="color: white; padding: 30px">
                                <div class="col-lg-11 col-md-12 col-sm-12 hidden-xs">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <br class="mg-t hidden-lg hidden-md hidden-sm">
                                            <span style="font-size: 20px; font-weight: bold" class="homepage">Welcome to <?php echo strtoupper($this->config->item("config_app_name")) ?> </span><br/><br/>
                                        </div>
                                        <div class="homepage col-sm-12">
                                            <br class="mg-b-lg">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <br class="mg-b-lg">
                                                    <small style="font-size: 100%;"><?php echo strtoupper($this->config->item("config_app_name")) ?> - <?php echo date('Y') ?> &COPY; <?php echo ucwords($this->config->item("config_client_name")); ?>. All Rights Reserved<br/>Powered by <?php echo anchor('http://' . strtoupper($this->config->item("config_company_site")), strtoupper($this->config->item("config_company")), 'target="_blank" style="color: white; font-style: italic;"') ?>.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right mg-b-md">
                    <h4><i class="fa fa-key mg-r-sm"></i><i>Change Password</i></h4>
                    <hr style="margin: 0px; padding: 0px; border-top: 1px solid grey"/>
                    <small><i>Update your password regularly, to avoid piracy</i></small>
                </div>
            </div>
            <div class="saving-pass"><?php echo $this->session->flashdata('msgpass'); ?></div>
            <div class="col-xs-12">
                <?= form_open('dash-v/my-profile/change-password', array('class' => 'form-horizontal ', 'id' => 'form-pass')); ?>
                <div class="form-group">
                    <label>Password Current</label>
                    <div class="input-group">
                        <span class="input-group-addon bg-dark text-white">Pass. Current</span>
                        <input type="password" name="old" class="form-control" placeholder="Password Current">

                    </div>
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <div class="input-group">
                        <span class="input-group-addon bg-dark text-white">Pass. New</span>
                        <input type="password" name="new" minlength="6" class="form-control" placeholder="Password New. Use min 6 character...">

                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-success col-sm-6 mg-t-md pull-right"><i class="fa fa-check mg-r-sm"></i>Change</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<div class="saving-acc col-xs-12"><?php echo $this->session->flashdata('msg'); ?></div>
<?= form_open('dash-v/my-profile/up-to-date', array('id' => 'form-acc')); ?>
<div class="col-sm-8">
    <section class="panel">
        <div class="panel-body">
            <h4><i class="fa fa-user mg-r-sm"></i><i>Your Data Account</i></h4>
            <hr style="margin: 0px; padding: 0px; border-top: 1px solid grey"/>
            <small><i>Provide information to your customers</i></small>
            <div class="row">
                <div class="col-xs-12 mg-t-md">
                    <div class="form-group">
                        <label>Fullname *</label>
                        <div class="input-group mg-b-md">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="fullname" value="<?php echo empty($sess['users']) ? null : ($sess['users']->users_fullname) ?>" class="form-control" placeholder="Fullname">
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" name="mail" value="<?php echo empty($sess['users']) ? null : ($sess['users']->users_mail) ?>" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xs-12 mg-b-lg">
            <button type="submit" class="btn btn-md btn-success col-sm-12 mg-t-lg pull-right"><i class="fa fa-check mg-r-sm"></i>Save Account</button>
        </div>
    </section>
</div>

<?= form_close(); ?>
<script>
    $('.reseter-option').selectize();
    $('.sortir-option-agent').selectize();
    $("#form-pass").submit(function () {
        $(".saving-pass").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
        $.ajax({
            url: $("#form-pass").attr('action'),
            data: $("#form-pass").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
                if (json.status == 0) {
                    $(".saving-pass").html(json.msg);
                } else {
                    $('#prof').load("<?php echo base_url() ?>dash-v/my-profile/content");
                }
            }
        });
        return false;
    });
    $("#form-acc").submit(function () {
        $(".saving-acc").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
        $.ajax({
            url: $("#form-acc").attr('action'),
            data: $("#form-acc").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
                if (json.status == 0) {
                    $(".saving-acc").html(json.msg);
                } else {
                    $('#prof').load("<?php echo base_url() ?>dash-v/my-profile/content");
                }
            }
        });
        return false;
    });
</script>-->
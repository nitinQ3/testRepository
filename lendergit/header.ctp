<?php
//pr($browser_details);
$user_name_email = $this->Session->read('user_name');
$user_name_display = $this->Session->read('user_displayname');
$client_name 			="";
$switched_client_name 	="";

$client_displayname 			= $this->Session->read('client_displayname');
$switched_client_displayname 	= $this->Session->read('switched_client_displayname');
if (!empty($switched_client_displayname)){
	$client_name = " - ".$switched_client_displayname;
        $id_client_name = $switched_client_displayname;
}
else { 
	$client_name = " - ".$client_displayname;
        $id_client_name = $client_displayname;
}
$is_closebar = 0;
$is_closebar =  $this->Session->read('is_closebar');
if(isset($_SESSION['is_closebar']) && $_SESSION['is_closebar']  == 1){
	$is_closebar = 1;
}

$user_type_id = $this->Session->read('user_type_id');
$user_client_id = $this->Session->read('client_id');
$display_switch_menu = $this->Session->read('display_switch_menu');
?>	
	<?php if($is_closebar == 1) { ?>
		
		<div original-title="Open sidebar" class="hide-btn top tip-s" style="left: -7px;"></div>
		<div original-title="Close sidebar" class="hide-btn center tip-s" style="left: -7px;"></div>
		<div original-title="Close sidebar" class="hide-btn bottom tip-s" style="left: -7px;"></div>
	<?php }else{ ?>
		<div class="hide-btn top tip-s" original-title="Close sidebar"></div>
		<div class="hide-btn center tip-s" original-title="Close sidebar"></div>
		<div class="hide-btn bottom tip-s" original-title="Close sidebar"></div>

	<?php }?>

<?php
		$top_header_height = "";
		$switched_client_id = $this->Session->read('switched_client_id');
		$previous_user_id = $this->Session->read('previous_user_id');
		$switch_user_displayname = $this->Session->read('user_displayname');
	    $switched_client_displayname = $this->Session->read('client_displayname');
	    if(!empty($switched_client_id) && $switched_client_id!=''){
	    	$top_header_height = "style=height:111px;";
	    }
	    
?>
		<div id="top" <?php echo $top_header_height;?> >
			<h1 id="logo"><?php echo $this->Html->link('','/dashboard/index/', array());?></h1>
			<div id="labels">			
				<ul>
					<li><a href="/" class="user">
                                                <span class="bar">Welcome <?php echo $user_name_display.$client_name; ?></span></a>
                                                <span id="id_user" style="display:none;"><?php echo $user_name_display; ?></span>
                                                <span id="id_email" style="display:none;"><?php echo $user_name_email;?></span>
                                                <span id="id_client" style="display:none;"><?php echo $id_client_name; ?></span>                                        
                                        </li>
					<li><?php echo $this->Html->link('','/profiles/', array('class'=> 'settings' ));?></li>
					<li class="subnav">
						<a href="/service/chat" class="messages"></a>
						<?php /* <!--<ul>
							<li><a href="#">New message</a></li>
							<li><a href="#">Inbox</a></li>
							<li><a href="#">Outbox</a></li>
							<li><a href="#">Trash</a></li>
						</ul>--> */ ?>
					</li>
					<li><?php echo $this->Html->link('','/logout/', array('class'=> 'logout' ));?></li>
				</ul>
			</div>                            
		
			<?php 
			
				if(!empty($switched_client_id)){
			?>
				<div class="message orange" style="margin: 0px 0px 2px 0px;height: 40px!important;">
					<span>
						Currently Impersonating <?php echo $switch_user_displayname; ?> at <?php echo $switched_client_displayname;?>.  <a href="/clients/switch_user/<?php echo $previous_user_id;?>">Stop Impersonating</a>
					</span>
				</div>
				<?php }?>
		
			
		<!-- 	<div class="alert alert-warning">Currently Impersonating (First Name) (Last Name) at (Client Name).  <a href="(link)">Stop Impersonating</a></div> -->
			<div id="menu">
				<ul>
				<?php
				
				/**
				* Lender Platform Menu:
				*/
				
				echo $this->MenuLink->menu(array( 
							'Home' =>'/dashboard/index'), 
							array(),'li',1 
							);  
							
				echo "<ul>";

					if($user_type_id  == CLIENT_ADMIN || $user_type_id  == CLIENT || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){
						echo $this->MenuLink->menu(array( 'Client Dashboard' => '/dashboard/client/'), 
							array(),'li',0 ); 
					}

					if($user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){
						echo $this->MenuLink->menu(array( 
							'Client Admin Dashboard' =>'/dashboard/admin/'), 
							array(),'li',0 
							);  
					}

					if( $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){
						echo $this->MenuLink->menu(array( 
							'Customer Service Dashboard' => '/dashboard/service/' ), 
							array(),'li',0 
							);  
					}


					if( $user_type_id  == VENDOR || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){
						echo $this->MenuLink->menu(array( 
							'Vendor Dashboard' => '/dashboard/vendor/' ), 
							array(),'li',0 
							);  
					}

					if( $user_type_id  == SYSTEM_ADMIN ){
						echo $this->MenuLink->menu(array( 
							'System Admin Dashboard' => '/dashboard/system/' ), 
							array(),'li',0 
							);  
					}	
					
							
				echo "</ul></li>";		

				if( $user_type_id  == CLIENT || $user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){				
					echo $this->MenuLink->menu(array( 
							'Files' => '/loans'), 
							array(),'li',1 
							); 
				} 
							
				echo "<ul>";

					if( $user_type_id  == CLIENT || $user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){
						echo $this->MenuLink->menu(array( 
							'New File' => '/loans/create'), 
							array(),'li',0 
							);  
					}


					if( $user_type_id  == CLIENT || $user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){
						
						echo $this->MenuLink->menu(array( 
							'Import Files' => '/loans/import'), 
							array(),'li',0 
							);  
					}

					if( $user_type_id  == CLIENT || $user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){
						
						echo $this->MenuLink->menu(array( 
							'Import Single' => '/loans/import_single'), 
							array(),'li',0 
							);  
					}

					
                                        if( $user_type_id  == CLIENT || $user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){
						
						echo $this->MenuLink->menu(array( 
							'Search Batches' => '/loans/batch'), 
							array(),'li',0 
							);  
					}

					if( $user_type_id  == CLIENT || $user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){
						
						echo $this->MenuLink->menu(array( 
							'Search/Browse Files' => '/loans'), 
							array(),'li',0 
							);  
					}
											
					echo "</ul></li>";	

				if( $user_type_id  == CLIENT || $user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){				
					echo $this->MenuLink->menu(array( 
							'Orders' => '/orders'), 
							array(),'li',1 
							); 
				} 
							
				echo "<ul>";

										
					if( $user_type_id  == CLIENT || $user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){
						echo $this->MenuLink->menu(array( 
							'New Order' => '/orders/wizard'), 
							array(),'li',0 
							);  
					}

					if( $user_type_id  == CLIENT || $user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){						
						echo $this->MenuLink->menu(array( 
							'Batch Processing' => '/orders/batch/'), 
							array(),'li',0 
							);  
					}

					if( $user_type_id  == CLIENT || $user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){
						echo $this->MenuLink->menu(array( 
							'Open Orders' => '/Orders?loan_number=&file_number=&order_asset=&product_type=&vendor_name=&product_code=&order_number=&client_order_id=&ordered_by=&order_status=6&advanced_search='), 
							array(),'li',0 
							);  
					}

					if( $user_type_id  == CLIENT || $user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){
						echo $this->MenuLink->menu(array( 
							'Completed Orders' => '/Orders?loan_number=&file_number=&order_asset=&product_type=&vendor_name=&product_code=&order_number=&client_order_id=&ordered_by=&order_status=5&advanced_search='), 
							array(),'li',0 
							);  
					}

					
					if( $user_type_id  == CLIENT || $user_type_id  == CLIENT_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){						
						echo $this->MenuLink->menu(array( 
							'Search/Browse Orders' => '/orders'), 
							array(),'li',0 
							);  
					}
                                        
                                        
					
							
					echo "</ul></li>";				
				
				if( $user_type_id  == VENDOR || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){		
					echo $this->MenuLink->menu(array( 
							'Vendor Portal' => '/vendors/orders'), 
							array(),'li',1 
							);  
				}
							
				echo "<ul>";


				if( $user_type_id  == VENDOR || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){		
					echo $this->MenuLink->menu(array( 
							'New Orders' => '/vendors/orders?loan_number=&file_number=&vendor_id=&product_type=&order_number=&order_status=1&search=1'), 
							array(),'li',0 
							);  
				}


				if( $user_type_id  == VENDOR || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){		
					echo $this->MenuLink->menu(array( 
							'Open Orders' => '/vendors/orders?loan_number=&file_number=&vendor_id=&product_type=&order_number=&order_status=6&search=1'), 
							array(),'li',0 
							);  
				}


				if( $user_type_id  == VENDOR || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){		
					echo $this->MenuLink->menu(array( 
							'Completed Orders' => '/vendors/orders?loan_number=&file_number=&vendor_id=&product_type=&order_number=&order_status=5&search=1'), 
							array(),'li',0 
							);  
				}

				if( $user_type_id  == VENDOR || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){		
					echo $this->MenuLink->menu(array( 
							'Search/Browse Orders' => '/vendors/orders'), 
							array(),'li',0 
							);  
				}
					
							
				echo "</ul></li>";	


				if( $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){					
				
					echo $this->MenuLink->menu(array( 
							'Customer Service' => '/dashboard/service'), 
							array(),'li',1 
							);  
				}
							
				echo "<ul>";


					if( $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){		

						echo $this->MenuLink->menu(array( 
							'Open Issues' => '/dashboard/service'), 
							array(),'li',0 
							);  
					}

					if( $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){		

						echo $this->MenuLink->menu(array( 
							'Search Orders' => '/orders'), 
							array(),'li',0 
							); 
					}

					if( $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){	
							 
						echo $this->MenuLink->menu(array( 
							'Search Users' => '/admin/users'), 
							array(),'li',0 
							); 
					}


					if( $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){					 
						
						echo $this->MenuLink->menu(array( 
							'Live Chat' => '/service/chat'), 
							array(),'li',0 
							);  
					}

					if( $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == SYSTEM_ADMIN ){					 
						
						echo $this->MenuLink->menu(array( 
							'Notes History' => '/orders/notes'), 
							array(),'li',0 
							);  
					}
				 
				
				echo "</ul></li>";	

				if($user_type_id != VENDOR ){

					echo $this->MenuLink->menu(array( 
							'Reports' => '/reports'), 
							array(),'li',1
							);  
					echo "<ul>";
								
						echo $this->MenuLink->menu(array( 
								'Orders by Month' => '/reports'), 
								array(),'li',0 
								);  
					echo "</ul>";
					/**
					* Not sure if we are going to DB enable reports yet.
					*/
					echo "<ul>";

					
					echo $this->MenuLink->menu(array( 
								'Orders By Month' => '/reports/order_by_month',
								'Orders by Product By Month' => '/reports/order_product_type',
								'Orders by Product' => '/reports/order_by_product',
								'Orders by Status' => '/reports/order_by_status',
								'Orders Transactions' => '/reports/transactions',
                                                                'Orders by Product Type' => '/reports/order_by_product_type',
								'Executive Summary' => '/reports/executive_summary',
								'Monthly Volumes' => '/reports/transactions_by_month',
								'Flood Zone Report' => '/reports/flood',
								'HMDA Report' => '/reports/hmda',
								'Lien Report' => '/reports/lien',								
								'Invoice Report' => '/reports/invoice_report',
								'Status Report' => '/reports/status_report',
								'Users Report' => '/reports/users',
                                                                'System Messages Report' => '/reports/system_messages',                                                              
                                                                'Vendor Due Diligence' => '/reports/vendor_due_diligence/',
                                                                'User Activity' => '/reports/users_activity/'.$user_client_id,
                                                                'Pipeline Report' => '/reports/pipeline',
								), 
								array(),'li',0 
								);  
                                        
                                        if($user_type_id == SYSTEM_ADMIN ){
                                            echo $this->MenuLink->menu(array( 
								'Failed Logins' => '/reports/failed_logins'), 
								array(),'li',0 
								);  
                                        }
					
					echo "</ul></li>";
				}	
				
					


				if( $user_type_id  == SYSTEM_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == CLIENT_ADMIN || $user_type_id  == VENDOR ){					 
					echo $this->MenuLink->menu(array( 
							'Admin' => '/admin'), 
							array(),'li',1 
							);  
				}
							
				echo "<ul>";

					if( $user_type_id  == CLIENT_ADMIN || $user_type_id  == SYSTEM_ADMIN || $user_type_id  == CUSTOMER_SERVICE ){					 
						
						echo $this->MenuLink->menu(array( 
							'Clients' => '/admin/clients'), 
							array(),'li',0 
							); 
					}


					if( $user_type_id  == CLIENT_ADMIN || $user_type_id  == SYSTEM_ADMIN || $user_type_id  == CUSTOMER_SERVICE || $user_type_id  == VENDOR ){					 
						
						 
					echo $this->MenuLink->menu(array( 
							'Users' => '/admin/users'), 
							array(),'li',0 
							);  
					}


					if( $user_type_id  == SYSTEM_ADMIN ){					 
						
					echo $this->MenuLink->menu(array( 
							'Vendors' => '/admin/vendors'), 
							array(),'li',0 
							);    
					}


					if( $user_type_id  == SYSTEM_ADMIN ){							
					
					echo $this->MenuLink->menu(array( 
							'Products' => '/admin/products'), 
							array(),'li',0 
							);  
					}



					if( $user_type_id  == SYSTEM_ADMIN ){							
					
					echo $this->MenuLink->menu(array( 
							'Product Templates' => '/admin/products/product_templates'), 
							array(),'li',0 
							);  
					}


					if( $user_type_id  == CLIENT_ADMIN ||  $user_type_id  == SYSTEM_ADMIN  || $user_type_id  == CUSTOMER_SERVICE){							
									
					
					echo $this->MenuLink->menu(array( 
							'Accounting' => '/accounting/'), 
							array(),'li',0 
							);  
					}


					//'Accounting' => '/accounting/',

					


					if( $user_type_id  == CLIENT_ADMIN ||  $user_type_id  == SYSTEM_ADMIN  || $user_type_id  == CUSTOMER_SERVICE){							
					
						echo $this->MenuLink->menu(array( 
							'Price Schedules' => '/admin/pricing'), 
							array(),'li',0 
							);  
					}

					if( $user_type_id  == CLIENT_ADMIN ||  $user_type_id  == SYSTEM_ADMIN ){							
					
						echo $this->MenuLink->menu(array( 
							'Client Overview' => '/admin/clients/browse'), 
							array(),'li',0 
							);
					}

					if( $user_type_id  == CLIENT_ADMIN ||  $user_type_id  == SYSTEM_ADMIN ){							
					
						echo $this->MenuLink->menu(array( 
							'Layouts' => '/admin/layouts'), 
							array(),'li',0 
							);
					}

					/* 
					echo $this->MenuLink->menu(array( 
							'Security' => '/admin/security'), 
							array(),'li',0 
							);  
					*/		
				echo "</ul></li>";		
				
				echo $this->MenuLink->menu(array( 
							'My Profile' => '/profiles'), 
							array(),'li',1 
							);  


				
				echo "<ul>";			
							
				    echo $this->MenuLink->menu(array( 
							'Edit' => '/profiles'), 
							array(),'li',0 
							);  
							
				//echo "</ul>";


				if( $user_type_id  == CLIENT_ADMIN || $user_type_id  == SYSTEM_ADMIN  || $user_type_id  == CUSTOMER_SERVICE ){						
				    echo $this->MenuLink->menu(array( 
							'Company Setup' => '/admin/clients/edit/'.$user_client_id), 
							array(),'li',0 
							);
				}


				if( $user_type_id  == VENDOR ){	
					$vendor_user_id = $this->Session->read('vendor_id');					
				    echo $this->MenuLink->menu(array( 
							'Company Setup' => '/admin/vendors/edit/'.$vendor_user_id), 
							array(),'li',0 
							);
				}
				if($display_switch_menu  > 0 ){
					echo $this->MenuLink->menu(array( 
							'Switch Client' => '/profiles/switch/'), 
							array(),'li',0 
							);
				}

				echo "</ul></li>";					
				
				?>
				
				
				</ul>
			</ul>
		</div>
	</div>
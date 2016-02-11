<?php

if (isset($open_search_box) && $open_search_box ==1) {
  $search_box = "block";
  $search_box_icon = "hide";
} else {
    $search_box = "none";
    $search_box_icon = "show";
}

//pr($loans);
//die;

?>
<div id="breadcrumbs">
    <ul>
        <li></li>
        <li><a href="/">Home</a></li>
        <li><a href="/reports">Reports</a></li>
        <li><a>Orders Transactions</a></li>
    </ul>
</div>
 <?php if(empty($errors)){ ?>          
<div class="section">
<?php echo $this->Form->create('User', array( array('controller'=>'reports', 'action'=> 'transactions'),'type'=>'POST')); ?>
    <div class="box">
        <div class="title">
            REPORT OPTIONS
            <span class="<?php echo $search_box_icon;?>"></span>
        </div>

        <div class="content" style="display:<?php echo $search_box;?>;">       
        <?php
          $search_client_id  = "";
         // pr($this->data);
          if(isset($this->data) && !empty($this->data['Report'])){
              $search_client_id       = $this->data['Report']['client_id'] ;
              $search_user_id         = $this->data['Report']['user_id'] ;
              $selected_loan_status_id = $this->data['Report']['loan_status'] ;
           
              if (isset($_POST['sub_clients'])){
                $search_test_mode       = $this->data['Report']['sub_clients'] ;
              } else {  $search_test_mode = '';}

             $date_from              = $this->data['Report']['date_from'];
             $date_to                = $this->data['Report']['date_to'];

            } else {
              $search_client_id       = '';
              $search_user_id         = '';         
              $selected_loan_status_id      = '';
              $search_test_mode       = '';
              $date_from              = '';
              $date_to                = '';
            }
            if (empty($date_from)){
              $date_from = date("m/d/Y", strtotime("-1 day"));
            }

            if (empty($date_to)){
              $date_to = date("m/d/Y") ;
            }

        ?>
            <div style="float:left;width:100%">
                <div style="float:left;width:50%;">
                    <div class="row" style="border-bottom: 0px;">
                        <label>Client</label>
                        <div class="right">
            <?php echo $this->Form->select('Report.client_id',$clients,array('default' => $search_client_id, 'class'=>'select big' ,'empty' => 'Any' ));?>
                        </div>
                    </div>
                </div>
                <div style="float:left;width:50%;">
                    <div class="row" style="border-bottom: 0px;" id="clientUserId">
                        <label>User</label>
                        <div class="right">
            <?php echo $this->Form->select('Report.user_id',$users_list, array('default' => $search_user_id, 'class'=>'select big' ,'empty' => 'Any'));?>
                        </div>
                    </div>
                </div>  
            </div> 


            <div style="clear:both;"></div>

            <div style="float:left;width:100%;" >
                <div style="float:left;width:50%;"> 
                    <div class="row">
                        <label>From</label>
                        <div class="right">          
            <?php             
              echo $this->Form->input('Report.date_from', array('label' => false, 'div'=>true, 'id'=>'date_from', 'minYear' => date('Y'),'error'=>false,'placeholder'=>'mm/dd/yyyy','class'=>'datepicker', 'value'=>$date_from));

              ?>
                        </div>
                    </div>
                </div>
                <div style="float:left;width:50%;">
                    <div class="row">
                        <label>To</label>
                        <div class="right">          
            <?php
              echo $this->Form->input('Report.date_to', array('label' => false, 'div'=>true, 'id'=>'date_to', 'minYear' => date('Y'),'error'=>false,'placeholder'=>'mm/dd/yyyy','class'=>'datepicker','default'=>date('m/d/Y'), 'value'=>$date_to));

              // echo $this->Form->input('Report.page_no', array('type'=>'hidden','label' => false, 'div'=>true, 'id'=>'page_no', 'error'=>false, 'default'=>2, 'value'=>$next_page_no));
              ?>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div>

            <div style="float:left;width:100%; border-bottom: 1px solid #E5E5E5;!important">
                <div style="float:left;width:50%;"> 
                    <div class="row" style="border-top: 0px solid #E5E5E5;border-bottom: 0px solid #E5E5E5;!important">
                        <label>Loan Status</label>
                        <div class="right" >
            <?php echo $this->Form->select('Report.loan_status',$loan_status,array('default' => $selected_loan_status_id, 'class'=>'select big' ,'empty' => 'Any'));?>
                        </div>
                    </div>
                </div>
                <div style="float:left;width:50%;" >
                    <div class="row" style="border-top: 0px solid #E5E5E5;border-bottom: 0px solid #E5E5E5;!important">
                        <label>Include Sub Clients</label>
                        <div class="right form_element_row">
              <?php
               if ($search_test_mode ==1) {
                  echo $this->Form->checkbox('Report.sub_clients', array( 'div'=>false, 'label'=>'Sub Clients', 'hiddenField' => false,'error'=>false ,'value'=>'1','checked'=>'checked'));
                }
                else{
                  echo $this->Form->checkbox('Report.sub_clients', array( 'div'=>false, 'label'=>'Sub Clients', 'hiddenField' => false,'error'=>false ,'value'=>'1'));               
                }         
              ?>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div class="row">
                <div class="right">
                <!-- <button type="submit" name="search_button"><span>Search</span></button>-->
                    <button type="submit" class="green" name="run_report"><span>Run Report</span></button>
                    <button type="submit" class="blue" name="download_report"><span>Download Report</span></button>
                </div>
            </div>

        </div>
    </div> 

    <div class="section">
  <?php echo $this -> Session -> flash(); ?>
  <?php if ($used_button_name =="run_report"){ ?>
        <div class="box">
            <div class="title">
                Lien Report
                <span class="hide"></span>
            </div>
            <div class="content" id="loadMoreDiv">
                <div class="dataTables_wrapper">
                    <div>
                        <div class="dataTables_filter"><label><input type="text" placeholder="Search"></label></div>
                    </div>

                    <table cellspacing="0" cellpadding="0" border="0" class="all" id="user_table"> 
                        <thead> 
                            <tr>
                                <th class="sorting_asc" rowspan="1" colspan="1" style="width: 75px;">Dept</th>    
                                <th class="sorting" rowspan="1" colspan="1" style="width: 130px;">User</th>
                                <th class="sorting" rowspan="1" colspan="1" style="width: 140px;">Loan Number</th>
                                <th class="sorting" rowspan="1" colspan="1" style="width: 280px;">Loan Amount</th>
                                <th class="sorting" rowspan="1" colspan="1" style="width: 100px;">Loan Type</th>
                                <th class="sorting" rowspan="1" colspan="1" style="width: 105px;">Term</th>
                                <th class="sorting" rowspan="1" colspan="1" style="width: 100px;">Loan Status</th>
                                <th class="sorting" rowspan="1" colspan="1" style="width: 60px;">Borrower</th>
                                <th class="sorting" rowspan="1" colspan="1" style="width: 60px;">Property</th>

                            </tr>
                        </thead>       
                        <tbody>

      <?php
      //pr($orders);
      $total_price = 0;
      if(!empty($loans)){ 
        $row =0;
        foreach($loans as $loan){ 
          $row++;
            if (isset($loan['LoanBorrower'])){
                $borrowers_name = array();
                    foreach($loan['LoanBorrower'] as $borrowers){
                        $fname = $lname = "";
                        if(!empty($borrowers['Contact']['first_name'])){
                        $fname = trim($borrowers['Contact']['first_name']);
                        }
                        if(!empty($borrowers['Contact']['last_name'])){
                        $lname = trim($borrowers['Contact']['last_name']);
                        }

                        if (!empty($fname) && !empty($lname)) {
                                $borrowers_name []= $lname .", ".$fname;
                        }
                        else if(empty($lname)){
                                $borrowers_name []= $fname;
                        }
                        else if(empty($fname)){ 
                                $borrowers_name []= $lname;
                        }
                    }
                    if (empty($borrowers_name)) { 
                        $borrowers_name = array();
                        $borrowers_name = array('Empty');

                    }
                //  pr($borrowers_name );
                }	
                $is_empty = "";	
                $borrower_name = implode ('<br>',$borrowers_name)	;
                if (empty($borrower_name)) { 
                $borrower_name ="(Empty)";
                $is_empty = "1";
            }
       
          
      ?>
        <tr class="odd">
            <td>
                 <span style="display:none;" id="<?php echo $loan['Loan']['id'] ;?>_loan_number"><?php echo $loan['Loan']['loan_number'] ;?></span>
               <?php if(!empty($loan['User']['ClientObject']['display_name'])) { echo $loan['User']['ClientObject']['display_name']; }else { echo "---";}?>
            </td>
            <td> 
                <?php if (isset($loan['User']['Contact']['first_name'])){
    echo $loan['User']['Contact']['first_name']." ".$loan['User']['Contact']['last_name'];
    }?></td>
            <td><?php if(!empty($loan['Loan']['loan_number'])) { echo $loan['Loan']['loan_number']; } else { echo "---";}?></td>
            <td><?php echo $this->Number->currency($loan['Loan']['loan_amount']);?></td>
            <td><?php
                    //pr($loan['LoanType']);
                     if (!empty($loan['LoanType'])) {
                                            echo $loan['LoanType']['label'] ; } 
                                    else { echo "---"; } ?></td>
            <td><?php echo $loan['Loan']['loan_term'];?></td>
            <td><?php              
                 if (!empty($loan['LoanStatus'])) {
                     echo $loan['LoanStatus']['name'] ;
                 } 
                 else { echo "---"; }
                 ?>
            </td>
            <td><?php echo $borrower_name;?></td>

            <td>
            <?php 
                if(!empty($loan['Address'])){
                    if(!empty($loan['Address']['address_1'])) echo $loan['Address']['address_1']."<br>"; 
                    if(!empty($loan['Address']['address_2'])) echo $loan['Address']['address_2']."<br>"; 
                    if(!empty($loan['Address']['city'])) echo $loan['Address']['city'].",";
                    if(!empty($loan['Address']['State']['state'])) echo $loan['Address']['State']['state'].",";
                    if(!empty($loan['Address']['zip'])) echo $loan['Address']['zip'];
                }else{
                    echo "---";
                }
            ?>
            </td>
        </tr>
      <?php 
      }}?> 
                        </tbody>
                    </table>
      <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
<?php }?>
    </div>



</div>


 <?php }?>

<script>
$("#ReportClientId").change(function(){
  
    var clientId = $(this).find('option:selected').val();
     
     if (clientId ==''){
       clientId = <?php echo $client_id ;?>
     }
      $.ajax({
      url:"/clients/ajax_get_users_loan_orders/"+clientId,
      success:function(result){
        $('#clientUserId').html('');    
        $('#clientUserId').html(result);        
      }});
      
  }); 
</script>
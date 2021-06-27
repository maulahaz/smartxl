<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "testing");
$columns = array('order_id', 'order_customer_name', 'order_item', 'order_value', 'order_date');

$query = "SELECT * FROM tbl_order WHERE ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'order_date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (order_id LIKE "%'.$_POST["search"]["value"].'%" 
  OR order_customer_name LIKE "%'.$_POST["search"]["value"].'%" 
  OR order_item LIKE "%'.$_POST["search"]["value"].'%" 
  OR order_value LIKE "%'.$_POST["search"]["value"].'%")
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY order_id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["order_id"];
 $sub_array[] = $row["order_customer_name"];
 $sub_array[] = $row["order_item"];
 $sub_array[] = $row["order_value"];
 $sub_array[] = $row["order_date"];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM tbl_order";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>


======
function read_search(){
		
		<tbody>
					
					<?php  
						$sn = 1;
						foreach ($ot_record->result() as $row) {
							$_ot_from = $this->mydatetime->get_nice_date($row->ot_date_from, 'overtime');
							$_ot_to = $this->mydatetime->get_nice_date($row->ot_date_to, 'overtime');

							$edt_uid = base_url()."overtime/create/".$row->uid;
							$del_uid = base_url()."overtime/del/".$row->uid;
					?>
					<tr>
						<td><?= $sn++; ?></td>
						<td><?= $_ot_from; ?></td>
						<td><?= $_ot_to; ?></td>
						<td><?= $row->ot_category; ?></td>
						<td><?= $row->ot_reason; ?></td>

						<!-- <td class="table-icon-cell">5</td>
						<td class="table-icon-cell">24</td>

						<td>6 minets ago</td> -->
						<td style="text-align: center; vertical-align: middle;" >
							<a href="<?= $edt_uid ?>" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
							<a href="<?= $del_uid ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash-o"></span></a>
							<!--With confirmation 
								<a href="<?= $del_uid ?>" onclick="return confirm('Sure to delete this data ?')" class="btn btn-danger btn-sm ladda-button"><span class="fa fa-trash-o"></span></a> 
							-->
						</td>
					</tr>
					<?php  
					}
					?>					
				</tbody>
	}
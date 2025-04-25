<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * inventory controller
 */
class Inventory extends App_Controller
{
	protected $permissionCreate = 'Gr_inventory.Inventory.Create';
	protected $permissionDelete = 'Gr_inventory.Inventory.Delete';
	protected $permissionEdit = 'Gr_inventory.Inventory.Edit';
	protected $permissionView = 'Gr_inventory.Inventory.View';
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict($this->permissionView);
		$this->load->model('gr_inventory/gr_inventory_model');
		$this->load->model('permintaan_pembelian/permintaan_pembelian_detil_model');
		$this->load->model('gudang/gudang_detil_model');
		$this->lang->load('gr_inventory');
		$this->form_validation->set_error_delimiters("<span class='error'>", "</span>");

		Template::set_block('sub_nav', 'inventory/_sub_nav');
		Assets::add_module_js('gr_inventory', 'gr_inventory.js');
	}

	/**
	 * Display a list of SK Tidak Mampu data.
	 *
	 * @return void
	 */
	public function index()
	{
		Template::set('toolbar_title', lang('gr_inventory_manage'));
		Template::render();
	}

	/**
	 * Create a SK Tidak Mampu object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict($this->permissionCreate);

		$gudang = $this->gr_inventory_model->get_gudang();
		Template::set('gudang', $gudang);

		if (isset($_POST['save'])) {
			if ($insert_id = $this->save_gr_inventory()) {
				log_activity($this->auth->user_id(), lang('gr_inventory_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'gr_inventory');
				Template::set_message(lang('gr_inventory_create_success'), 'success');

				redirect(SITE_AREA . '/inventory/gr_inventory');
			}

			// Not validation error
			if (!empty($this->gr_inventory_model->error)) {
				Template::set_message(lang('gr_inventory_create_failure') . $this->gr_inventory_model->error, 'error');
			}
		}

		$detil = $this->gr_inventory_model->get_detil();
		// dump($detil);
		// die;
		Template::set('detil', $detil);

		Template::set('toolbar_title', lang('gr_inventory_action_create'));
		Template::render();
	}

	/**
	 * Allows editing of SK Tidak Mampu data.
	 *
	 * @return void
	 */

	public function edit()
	{
		$id = $this->uri->segment(5);
		if (empty($id)) {
			Template::set_message(lang('gr_inventory_invalid_id'), 'error');
			redirect(SITE_AREA . '/inventory/gr_inventory');
		}

		$gudang = $this->gr_inventory_model->get_gudang();
		Template::set('gudang', $gudang);

		$detil = $this->gr_inventory_model->get_detil();
		Template::set('detil', $detil);

		// $selected = $this->gr_inventory_model->get_gr_detail_gudang_id();
		// Template::set('selected', $selected);

		$ppd_id = $this->db->select('id')->from('permintaan_pembelian_detil')->get()->result();
		$list = array_map('intval', array_column($ppd_id, 'id'));

		if (isset($_POST['save'])) {
			$this->auth->restrict($this->permissionEdit);

			if ($this->save_gr_inventory('update', $id)) {
				log_activity($this->auth->user_id(), lang('gr_inventory_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'gr_inventory');
				Template::set_message(lang('gr_inventory_edit_success'), 'success');
				redirect(SITE_AREA . '/inventory/gr_inventory');
			}

			// Not validation error
			if (!empty($this->gr_inventory_model->error)) {
				Template::set_message(lang('gr_inventory_edit_failure') . $this->gr_inventory_model->error, 'error');
			}
		} elseif (isset($_POST['delete'])) {
			$this->auth->restrict($this->permissionDelete);

			$datess = [
				'tanggal_gr' => date("Y-m-d"),
				'tipe' => NULL,
				'gr_inventory_id' => NULL,
			];

			$this->db->where('gr_inventory_id', $id);
			$this->db->update('permintaan_pembelian_detil', $datess);

			$this->db->where_in('permintaan_pembelian_detil_id', $list);
			$this->db->delete('gudang_detil');
			if ($this->gr_inventory_model->delete($id)) {
				log_activity($this->auth->user_id(), lang('gr_inventory_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'gr_inventory');
				Template::set_message(lang('gr_inventory_delete_success'), 'success');
				redirect(SITE_AREA . '/inventory/gr_inventory');
			}

			Template::set_message(lang('gr_inventory_delete_failure') . $this->gr_inventory_model->error, 'error');
		}

		// $dataz = [];
		// foreach ($list as $l) {
		// 	$dataz[] = $l;
		// }

		// $data = $this->db->select('tanggal')->from('gr_inventory')->get()->result_array();
		// $list = array_column($data, 'tanggal');

		// Ubah format tanggal sebelum implode
		// $formatted_dates = array_map(fn($tanggal) => date('Y-m-d', strtotime($tanggal)), $list);


		// $pp = $this->gr_inventory_model->permintaan_pembelian();

		// $tanggals = explode(',', $pp);
		// $permintaan_pembelian_ids = array_column($pp, 'tanggal_gr');
		// $format = array_map(fn($tanggal) => date('Y-m-d', strtotime($tanggal)), $permintaan_pembelian_ids);
		// $implode_cuy = implode(', ', $format);
		// dump($implode_cuy);
		// die;

		// $this->db->where_in('tanggal', $format);
		// $query = $this->db->get_compiled_select('gr_inventory');
		// dump($query);
		// die;

		// Get detail data
		$detil_selected = $this->permintaan_pembelian_detil_model->get_by_relation_gudang(['gr_inventory_id' => $id]);
		// dump($detil_selected);
		// die;

		$detil_available = $this->permintaan_pembelian_detil_model->get_by_relation_gudang(['gr_inventory_id IS NULL' => NULL]);

		// Set data for view
		Template::set('gr_inventory', $this->gr_inventory_model->find($id));
		Template::set('detil_selected', $detil_selected);
		Template::set('detil_available', $detil_available);
		Template::set('toolbar_title', lang('gr_inventory_edit_heading'));
		Template::render();
	}


	//--------------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------------

	/**
	 * Save the data.
	 *
	 * @param string $type Either 'insert' or 'update'.
	 * @param int    $id   The ID of the record to update, ignored on inserts.
	 *
	 * @return boolean|integer An ID for successful inserts, true for successful
	 * updates, else false.
	 */
	private function save_gr_inventory($type = 'insert', $id = 0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		// Validate the data
		$this->form_validation->set_rules($this->gr_inventory_model->get_validation_rules());
		if ($this->form_validation->run() === false) {
			return false;
		}

		// Make sure we only pass in the fields we want
		// $data = $this->gr_inventory_model->prep_data($this->input->post());
		$data = [];

		// Additional handling for default values should be added below,
		// or in the model's prep_data() method
		// $data['tanggal'] = $this->input->post('tanggal') ? $this->input->post('tanggal') : '0000-00-00';

		$selected_items = $this->input->post('selected_ids');
		// $selected_itemp = array_column($selected_item, 'id');
		$selected_item = json_decode($selected_items, true);
		// $selected_itemz_id = array_map('intval', $selected_itemp);

		$tanggal = $this->input->post('tanggal') ? $this->input->post('tanggal') : '0000-00-00';
		$deskripsi = $this->input->post('deskripsi');

		foreach ($selected_item as $item) {
			$data[] = [
				'tanggal' => $tanggal,
				'gudang_id' => $item['gudang_id'],
				'deskripsi' => $deskripsi
			];
		}

		$return = false;
		if ($type == 'insert') {
			// $id = $this->gr_inventory_model->insert($data);
			// $id = $this->db->insert_batch('gr_inventory', $data);
			$inserted_ids = [];
			foreach ($data as $row) {
				$this->db->insert('gr_inventory', $row);
				$inserted_ids[] = $this->db->insert_id(); // Simpan ID setelah insert
			}


			if (is_numeric($id)) {
				$return = $id;
			}

			// $datas = [
			// 	'tanggal_gr' => date('Y-m-d'),
			// 	'tipe' => TRUE,
			// 	'gr_inventory_id' => $id,
			// ];

			$gudang_data = [];

			foreach ($selected_item as  $key => $item) {
				$gudang_data[] = [
					'gudang_id' => $item['gudang_id'],
					'jumlah' => $item['id_jumlah'],
					'tanggal_masuk' => $tanggal,
					'deskripsi' => $item['deskripsi'],
					'permintaan_pembelian_detil_id' => (int) $item['id'],
					// 'gr_inventory_id' => $id,
				];
			}

			// dump($gudang_data);
			// die;

			// $gudang_saja = [
			// 	'gudang_id' => $data['gudang_id'],
			// 	'permintaan_pembelian_detil_id' => (int) $selected_itemz[0],
			// 	'gr_inventory_id' => $id,
			// ];

			foreach ($selected_item as $index => $item) {
				$datas = [
					'tanggal_gr' => date('Y-m-d'),
					'tipe' => TRUE,
					'gr_inventory_id' => $inserted_ids[$index],
				];

				$this->db->where('id', $item['id']);
				$this->db->update('permintaan_pembelian_detil', $datas);
			}
			$this->db->insert_batch('gudang_detil', $gudang_data);
		} elseif ($type == 'update') {
			// dump($this->input->post());
			// die;
			$return = $this->gr_inventory_model->update($id, $data);
			$selected_ids = explode(', ', $this->input->post('selected_ids'));

			$ppd_id = $this->db->select('id')->from('permintaan_pembelian_detil')->get()->result();
			$list = array_map('intval', array_column($ppd_id, 'id'));

			// Reset semua item yang terkait dengan group ini
			// dump($selected_itemz);
			// die;
			// $this->db->where_in('gr_inventory_id', $id)

			$this->db->where_in('gr_inventory_id', $id)
				->update('permintaan_pembelian_detil', [
					'gr_inventory_id' => NULL,
					'tanggal_gr' => NULL,
					'tipe' => NULL
				]);
			if ($return && $this->input->post('selected_ids')) {
				// Handle selected items for both insert and update
				// $datase = [
				// 	'gudang_id' => NULL,
				// 	'permintaan_pembelian_detil_id' => NULL,
				// 	// 'gr_inventory_id' => $id
				// ];

				foreach ($list as $ls) {
					$this->db->where('permintaan_pembelian_detil_id', $ls)
						->delete('gudang_detil');
				}

				// Update items yang dipilih
				if (!empty($selected_ids)) {
					$this->db->where_in('id', array_column($selected_item, 'id'))
						->update('permintaan_pembelian_detil', [
							'gr_inventory_id' => $id,
							'tanggal_gr' => date("Y-m-d"),
							'tipe' => TRUE
						]);
				}

				$this->db->where_in('permintaan_pembelian_detil_id', $list);
				$this->db->delete('gudang_detil',);

				$gudang_data_edit = [];
				foreach ($selected_item as  $key => $item) {
					$gudang_data_edit[] = [
						'gudang_id' => $data['gudang_id'],
						'jumlah' => $item['id_jumlah'],
						'tanggal_masuk' => $data['tanggal'],
						'deskripsi' => $item['deskripsi'],
						'permintaan_pembelian_detil_id' => (int) $item,
						// 'gr_inventory_id' => $id,
					];
				}

				// foreach ($gudang_data_edit as $row) {
				// 	$this->db->where_in('permintaan_pembelian_detil_id', $list);
				// 	$this->db->update('gudang_detil', $row);
				// }
				// $data_gudang_detil = [
				// 	'gudang_id' => $data['gudang_id'],
				// 	'permintaan_pembelian_detil_id' => $selected_itemz[0]
				// ];
				// $this->db->where('gr_inventory_id', $id)
				// 	->update('gudang_detil', $data_gudang_detil);
				$this->db->insert_batch('gudang_detil', $gudang_data_edit);
			}
		}
		return $return;
	}

	public function get_data()
	{
		$return = $this->gr_inventory_model->find_all_gr_inventory();
		echo json_encode($return);
	}
}

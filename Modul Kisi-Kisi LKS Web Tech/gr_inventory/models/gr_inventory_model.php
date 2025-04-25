<?php defined('BASEPATH') || exit('No direct script access allowed');

class Gr_inventory_model extends DT_Model
{
	public $table_name = 'gr_inventory';
	protected $key = 'id';
	protected $date_format = 'datetime';

	protected $log_user = true;
	protected $set_created = false;
	protected $set_modified = false;
	protected $soft_deletes = false;

	protected $created_field = 'created_on';
	protected $created_by_field = 'created_by';
	protected $modified_field = 'modified_on';
	protected $modified_by_field = 'modified_by';
	protected $deleted_field = 'deleted';
	protected $deleted_by_field = 'deleted_by';

	// Customize the operations of the model without recreating the insert,
	// update, etc. methods by adding the method names to act as callbacks here.
	protected $before_insert = array();
	protected $after_insert = array();
	protected $before_update = array();
	protected $after_update = array();
	protected $before_find = array();
	protected $after_find = array();
	protected $before_delete = array();
	protected $after_delete = array();

	// For performance reasons, you may require your model to NOT return the id
	// of the last inserted row as it is a bit of a slow method. This is
	// primarily helpful when running big loops over data.
	protected $return_insert_id = true;

	// The default type for returned row data.
	protected $return_type = 'object';

	// Items that are always removed from data prior to inserts or updates.
	protected $protected_attributes = array('id');

	// You may need to move certain rules (like required) into the
	// $insert_validation_rules array and out of the standard validation array.
	// That way it is only required during inserts, not updates which may only
	// be updating a portion of the data.
	protected $validation_rules = array(
		array(
			'field' => 'tanggal',
			'label' => 'lang:gr_inventory_field_tanggal',
			'rules' => 'required',
		),
		array(
			'field' => 'gudang_id',
			'label' => 'lang:gr_inventory_field_gudang_id',
			'rules' => 'max_length[50]',
		),
		array(
			'field' => 'deskripsi',
			'label' => 'lang:gr_inventory_field_deskripsi',
			'rules' => 'max_length[255]',
		),
	);
	protected $insert_validation_rules = array();
	protected $skip_validation = false;

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function get_gudang()
	{
		return $this->db->select('id, nama')->from('gudang')->get()->result();
	}

	public function permintaan_pembelian()
	{
		return $this->db->select('tanggal_gr')->from('permintaan_pembelian_detil')->get()->result_array();
		// $this->db->where_in('tanggal_gr', $tanggal);
		// return $this->db->get('permintaan_pembelian_detil')->result();
	}

	public function	gr_inventory_detil()
	{
		return $this->db->select('id, deskripsi')->from('gr_inventory')->get()->result();
	}

	// public function get_gr_detail_gudang_id()
	// {
	// 	return $this->db->select('gudang_id')->from('permintaan_pembelian_detil')->get()->result_array();
	// }

	public function get_detil()
	{
		$data = $this->db
			->select('ppd.*, m.nama as material_nama, s.nama as satuan_nama, gd.gudang_id as gudang_id, g.nama as nama_gudang')
			->from('permintaan_pembelian_detil ppd')
			->join('jenis m', 'm.id = ppd.material_id', 'left')
			->join('satuan s', 's.id = ppd.satuan_id', 'left')
			->join('gr_inventory gr', 'gr.id = ppd.gr_inventory_id', 'left')
			->join('gudang_detil gd', 'gd.permintaan_pembelian_detil_id = ppd.id', 'left')
			->join('gudang g', 'g.id = gd.gudang_id', 'left')
			// ->join('gudang_detil g', 'g.id = ppd.gudang_id', 'left')
			// ->join('permintaan_pembelian pp', 'pp.id = ppd.permintaan_pembelian_id', 'left')
			// ->where('ppd.penerimaan_id IS NULL', null, false)
			// ->where('ppd.gr_inventory_id IS NULL', null, false)
			->where('gd.permintaan_pembelian_detil_id IS NOT NULL', null, false)
			->where('gd.gudang_id IS NOT NULL', null, false)
			->order_by('ppd.id', 'DESC')
			->get()
			->result();
		// dump($this->db->last_query());
		// die;
		return $data;
	}

	public function find_all_gr_inventory()
	{
		$this->db->select('a.*, b.nama as nama_gudang');
		$this->db->from('gr_inventory a');
		$this->db->join('gudang b', 'a.gudang_id = b.id', 'left', false);

		$request = $this->input->post();
		// $this->db->where('a.active', true);

		$total_records = $this->db->count_all_results('', false);

		if (!empty($request['search']['value'])) {
			$search_value = $request['search']['value'];

			$this->db->group_start();
			$this->db->like('LOWER(a.deskripsi)', strtolower($search_value));
			$this->db->or_like('LOWER(b.nama)', strtolower($search_value));
			$this->db->group_end();
		}

		$filtered_records = $this->db->count_all_results('', false);

		if (isset($request['length']) && $request['length'] != -1) {
			$this->db->limit($request['length'], $request['start']);
		}

		$query = $this->db->get();
		$data = $query->result();

		$output = [
			'draw' => isset($request['draw']) ? intval($request['draw']) : 1,
			'recordsTotal' => $total_records,
			'recordsFiltered' => $filtered_records,
			'data' => $data
		];

		return $output;
	}

	/**
	 * Get detail items for specific group
	 * @param int $group_id
	 * @return array
	 */

	public function get_detil_by_group($group_id)
	{
		return $this->db
			->select('ppd.*, m.nama as material_nama, s.nama as satuan_nama')
			->from('permintaan_pembelian_detil ppd')
			->join('jenis m', 'm.id = ppd.material_id', 'left')
			->join('satuan s', 's.id = ppd.satuan_id', 'left')
			// ->join('gudang g', 'g.id = ppd.gudang_id', 'left')
			->where('ppd.pp_group_id', $group_id)
			->order_by('ppd.id', 'DESC')
			->get()
			->result();
	}

	/**
	 * Get available detail items (not in any group)
	 * @return array
	 */


	public function get_detil_available()
	{
		return $this->db
			->select('ppd.*, m.nama as material_nama, s.nama as satuan_nama')
			->from('permintaan_pembelian_detil ppd')
			->join('jenis m', 'm.id = ppd.material_id', 'left')
			->join('satuan s', 's.id = ppd.satuan_id', 'left')
			// ->join('gudang g', 'g.id = ppd.gudang_id', 'left')
			->where('ppd.pp_group_id IS NULL', null, false)
			->order_by('ppd.id', 'DESC')
			->get()
			->result();
	}

	/**
	 * Update group items
	 * @param int $group_id
	 * @param array $item_ids
	 * @return bool
	 */
	public function update_group_items($group_id, $item_ids)
	{
		// First, reset all items for this group
		$this->db->where('gudang_id', $group_id)
			->update('gudang_detil', ['gudang_id' => NULL]);

		// Then update selected items
		if (!empty($item_ids)) {
			return $this->db->where_in('id', $item_ids)
				->update('gudang_detil', ['gudang_id' => $group_id]);
		}

		return true;
	}
}

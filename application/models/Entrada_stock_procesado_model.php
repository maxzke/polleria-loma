<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Entrada_stock_procesado_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
    * Select Procesado por Lote y Categoria
    */
    function get_por_lote_y_categoria($lote,$categoria){
        return $this->db->get_where('entrada_stock_procesado',array('lote'=>$lote,'categoria'=>$categoria))->result_array();
    }
    
    /*
     * Get entrada_stock_procesado by id
     */
    function get_entrada_stock_procesado($codigo)
    {
        return $this->db->get_where('entrada_stock_procesado',array('codigo'=>$codigo))->row_array();
    }

    /*
    *   Get stock por categoria
    */
    function getStock($categoria){
        $this->db->select('id,kilos,stock_cantidad,stock_kilos');   
        $this->db->where('categoria',$categoria);   
        $this->db->where('status','disponible');   
        return $this->db->get('entrada_stock_procesado')->result_array();
        //echo json_encode($this->db->get('entrada_stock_procesado')->result_array());
    }

    function getAllStock(){
        $this->db->select('id,categoria,kilos,lote,stock_cantidad,stock_kilos');
        $this->db->where('status','disponible');   
        return $this->db->get('entrada_stock_procesado')->result_array();
        //echo json_encode($this->db->get('entrada_stock_procesado')->result_array());
    }

    function getLotes($categoria){
        $this->db->select('lote');
        $this->db->where('status','disponible');   
        $this->db->where('categoria',$categoria);  
        $this->db->group_by('lote');   
        return $this->db->get('entrada_stock_procesado')->result_array();
    }
    
    /*
     * Get all entrada_stock_procesados count
     */
    function get_all_entrada_stock_procesados_count()
    {
        $this->db->from('entrada_stock_procesado');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all entrada_stock_procesados
     */
    function get_all_entrada_stock_procesados($params = array())
    {
        $this->db->order_by('id', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('entrada_stock_procesado')->result_array();
    }
        
    /*
     * function to add new entrada_stock_procesado
     */
    function add_entrada_stock_procesado($params)
    {
        $this->db->insert('entrada_stock_procesado',$params);
        return $this->db->insert_id();
    }
    function revisaExistecodigo($codigo){
        $this->db->where('codigo',$codigo);
        return $this->db->get('entrada_stock_procesado')->result();
    }
    /*
     * function to update entrada_stock_procesado
     */
    function update_entrada_stock_procesado($codigo,$params)
    {
        $this->db->where('codigo',$codigo);
        return $this->db->update('entrada_stock_procesado',$params);
    }

    function update_entrada_stock_status($codigo,$params)
    {
        $this->db->where('codigo',$codigo);
        return $this->db->update('entrada_stock_procesado',$params);
    }

    
    
    /*
     * function to delete entrada_stock_procesado
     */
    function delete_entrada_stock_procesado($id)
    {
        return $this->db->delete('entrada_stock_procesado',array('id'=>$id));
    }

    /*
     * function to Guarda procesado e incrementa procesado
     *  by Codigo de barras
     * usando transaccion
     */
    function add_stock_procesado_by_code($param){

        date_default_timezone_set('America/Mexico_City');
        $now = date('d-m-Y H:i:s');

        $this->db->trans_begin();

        foreach($param as $item){

            $insertParams = array(
                'categoria' => $item['categoria'],
                'codigo' => $item['id'],
                'codigo_interno' => $item['id_interno'],
                'kilos' => $item['peso'],
                'lote' => $item['lote'],
                'cantidad' => $item['cantidad'],                
                //se encargará de lelvar el stock
                'status' => 'disponible',
                'stock_cantidad' => $item['cantidad'],
                'stock_kilos' => $item['peso'],
                // fin se encargará de llevar el stock
                'usuario' => $_SESSION['name'],
                'fecha' => $now,
            );
            $existe = $this->revisaExistecodigo($item['id']);

            if (!$existe) {
                $this->add_entrada_stock_procesado($insertParams);
            }
        }

        if ($this->db->trans_status() === FALSE){      
            //Hubo errores en la consulta, entonces se cancela la transacción.   
            $this->db->trans_rollback();      
            return false;    
         }else{      
            //Todas las consultas se hicieron correctamente.  
            $this->db->trans_commit();    
            return true;    
         }  

        

    }




}

<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

// require __DIR__ . '../autoload.php';
// use Mike42\Escpos\Printer;
// use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class Ticket extends CI_Controller {

    public function __construct(){
        parent :: __construct();
        $this->load->model('Ticket_model');
    }

    public function ticketCompleto(){
        $id = $this->input->post('id');
        $data['datos'] = $this->datosVenta($id);
        $data['abonos'] = $this->historialAbonos($id);
        $data['sumaAbonos'] = $this->totalAbonos($id);
        $TotalAbonos = $data['datos'][0]->pago + $data['sumaAbonos'][0]->total;
        $data['totalAbonos'] = $TotalAbonos;
        $data['detalles'] = $this->detallesVenta($id);
        echo json_encode($data);
    }
    /*
    *   Get datos venta By Id Venta
    */
    private function datosVenta($id){
        return $this->Ticket_model->datosVenta($id);         
    }
    /*
    *   Historial abonos By Id Venta
    */
    private function historialAbonos($id){
        return $this->Ticket_model->abonos($id);
    }
    /*
    *   Suma Importe abonos By Id Venta
    */
    private function totalAbonos($id){
        return $this->Ticket_model->sumaAbonos($id);
    }
     /*
    *   Detalles Venta By Id Venta
    */
    private function detallesVenta($id){
        return $this->Ticket_model->detalles($id);
    }
    

	



}// end class
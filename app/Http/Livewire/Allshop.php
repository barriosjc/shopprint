<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Allshop extends Component
{
    use WithFileUploads;

    public $cartCollection = [];
    public $subtotal;
    public $items;
    public $totalInt;
    public $totalDec;
    public $incremento;
    public $quantity;
    public $print = [];
    public $cut = [];
    public $hid_print = [];
    public $print_ok = [];
    public $cut_ok = [];
    public $hid_cut = [];
    public $cli_shop = [];
    public $cli_po = [];
    public $observation;
    public $showP = [];
    public $showC = [];
    // public $agregar;
    protected $listeners = ['valorAntesDeModificar'];

    // public function valorAntesDeModificar($valor)
    // {
    //     // $this->agregar = $valor;
    //     $id = $valor[1];
    //     $this->incremento = $valor[0];

    // }
    public function fileUploaded_print($key)
    {
        $this->showP[$key] = true;
    }

    public function fileUploaded_cut($key)
    {
        $this->showC[$key] = true;
    }

    public function mount(){
        $totalAmount = 0;
        $this->cartCollection = \Cart::getContent();
        // dd($this->cartCollection);
        foreach ($this->cartCollection as $item) {
            $totalAmount = $totalAmount + ($item['price'] * $item['quantity']);
        }
        $subtotal = $totalAmount;
        if (strpos($subtotal, '.') !== false) {
            $array = explode('.', $subtotal);
            $entero = $array[0];
            $dec = str_pad($array[1], 2, "0", STR_PAD_RIGHT);
        } else {
            $entero = $subtotal;
            $dec = "00";
        }
        $this->totalInt = $entero;
        $this->totalDec = $dec;

    }

    public function render()
    {
        return view('livewire.allshop');
    }

    public function variaCantidad($id)
    {
        $cart = \Cart::getContent();
        $incremento = ($this->cartCollection[$id]['quantity'] - $cart[$id]['quantity']);

        \Cart::update(
            $id,
            array(
                'quantity' => $incremento
            ),
        );
    }

    public function remove($id)
    {
        \Cart::remove($id);
    }

    public function clearAll()
    {

        \Cart::clear();
        \cart::session(Auth()->user()->id)->clear();

        return redirect()->route('home')->with('success_msg', 'Car is cleared!');
    }

    // public function datos_original($rowId){    
    public function datos_original()
    {
        $archivos = '';
        $observation = null;

        if (!empty($this->print)) {
            foreach ($this->print as $key => $print) {
                if (isset($this->cartCollection[$key]['observation'])) {
                    $obs = $this->cartCollection[$key]['observation'];
                }
                $carpeta =  Auth()->user()->id;
                $path = $print->store($carpeta, 'clientes'); 

                \Cart::update(
                    $key,
                    [
                        'path_print' => $path,
                        'observation' => $obs
                    ],
                );
            }
        }

        if (!empty($this->cut)) {
            foreach($this->cut as $key => $cut) {
                if (isset($this->cartCollection[$key]['observation'])) {
                    $obs = $this->cartCollection[$key]['observation'];
                }      
                $carpeta =  Auth()->user()->id;
                $path = $cut->store($carpeta, 'clientes'); 
      
                \Cart::update(
                    $key, [
                        'path_cut' => $path,
                        'observation' => $obs
                    ]
                );
            }            
        }
        
        if (!empty($this->cli_shop)) {
            foreach ($this->cli_shop as $key => $shop) {
                \Cart::update(
                    $key,
                    [
                        'cli_shop' => $shop
                    ],
                );
            }
        }

        if (!empty($this->cli_po)) {
            foreach ($this->cli_po as $key => $po) {
                \Cart::update(
                    $key,
                    [
                        'cli_po' => $po
                    ],
                );
            }
        }
        //   $cart = \Cart::getContent(); 
        //  dd("mostrar this",$this, $path, $cart);

        return redirect()->route('cart.entrega');
    }
}

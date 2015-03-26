<?php  namespace eBilett;

class eBillett {

	/**
	 * Partner ID
	 * @var 	integer
	 * @access 	protected
	 */
	protected $p_id;

	/**
	 * Endpoints URL
	 * @var 	integer
	 * @access 	protected
	 */
	protected $endpoint = 'http://dx.no/ebillett/dx_forestillinger.php?type=XML';

	/**
	 * Ticket URL
	 * @var 	integer
	 * @access 	protected
	 */
	protected $ticket = 'https://pay.ebillett.no/velg_antall.php?frs_pris=&dato=';

	/**
	 * Parsed items
	 *
	 * @var 	array
	 * @access 	private
	 **/
	private $items;

	/**
	 * Sets some values and prepares parsing
	 *
	 * @return 	void
	 * @access 	public
	 **/
	public function __construct($p_id) {

		$this->p_id 		= $p_id;
		$this->endpoint 	= $this->endpoint . '&p_id='. $p_id;
		$this->ticket 		= $this->ticket . '&p_id='. $p_id;

		$this->parse();

	}

	/**
	 * Parses the endpoint XML
	 *
	 * @return 	void
	 * @access 	private
	 **/
	private function parse() {

		// remote get contents
		$contents 	= file_get_contents( $this->endpoint );

		// parse xml
		$feed 		= simplexml_load_string($contents);

		// empty array
		$items = array();

		// 
		foreach( $feed as $item ) {
			$id = (int) $item->ShowID;
			$items[$id] = array(
				'title' 		=> (string) $item->MovieTitle,
				'url' 			=> (string) $this->ticket . '&frs_id='. $id,
				'date'			=> (int) strtotime($item->ShowDate),
				'start'			=> (int) strtotime($item->ShowDate . ' ' . $item->ShowTime),
				'end'			=> (int) strtotime($item->ShowDate . ' ' . $item->EndTime),
				'sale_start'	=> (int) strtotime($item->DateStartSale),
				'availiable'	=> (int) $item->Ledig,
				'sold'			=> (int) $item->AntallSolgt,
			);
		}

		$this->items = $items;

	}

	/**
	 * Gets a specific ticket ID
	 * 
	 * If no id is supplied it will get all
	 *
	 * @param 	integer $id
	 * @return 	array|boolean
	 * @access 	public
	 **/
	public function get( $id = null ) {

		if( $id && isset($this->items[$id]) ) {
			return $this->items[$id];
		}
		
		return $this->items;
	}

}

?>
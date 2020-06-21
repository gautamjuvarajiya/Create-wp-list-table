<?php
/*
 * Plugin Name: Gautam WP List Table Example
 * Description: An example of how to use the WP_List_Table class to display data in your WordPress Admin area
 * Plugin URI: 
 * Author: Gautam Juvarajiya
 * Author URI: 
 * Version: 1.0
 */

if(is_admin())
{
    new Gautam_Wp_List_Table();
}

/**
 * Gautam_Wp_List_Table class will create the page to load the table
 */
class Gautam_Wp_List_Table
{
    
     // Here Constructor will create the menu item
    
    public function __construct()
    {
        add_action( 'admin_menu', array($this, 'add_menu_example_list_table_page' ));
    }

    
      // Here Menu item will allow us to load the page to display the table
     
    public function add_menu_example_list_table_page()
    {
        add_menu_page( 'Example List Table', 'Example List Table', 'manage_options', 'example-list-table.php', array($this, 'list_table_page') );
    }

    /**
     * Display the list table page
     *
     * @return Void
     */
    public function list_table_page()
    {
        $exampleListTable = new Example_List_Table();
        $exampleListTable->prepare_items();
        ?>
            <div class="wrap">
                <div id="icon-users" class="icon32"></div>
                <h1>Example List Table Page</h1>
                <?php $exampleListTable->display(); ?>
            </div>
        <?php
    }
}

// WP_List_Table is not loaded automatically so we have to load it manually
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}


  // Creating a new table class (Example_List_Table) that will extend the WP_List_Table

class Example_List_Table extends WP_List_Table
{
    /**
     * Preparing/getting the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
        // usort() function sorts an array using a user-defined comparison function.
        usort( $data, array( &$this, 'sort_data' ) );  


     /* $perPage = 2;                         //optional lines 81-91
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) ); 

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);
     */
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data; 
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'id'          => 'ID',
            'title'       => 'Title',
            'description' => 'Description',
            'year'        => 'Year',
            'director'    => 'Director',
            'rating'      => 'Rating'
        );

        return $columns;
    }

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array('id' => array('id', false));
    }

    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data()
    {
        $data = array();

        $data[] = array(
                    'id'          => 1,
                    'title'       => 'Avengers',
                    'description' => 'Earth\'s Mightiest Heroes stand as the planet\'s first line of defense against the most powerful threats in the universe.',
                    'year'        => '2012',
                    'director'    => 'Joss Whedon, Joe Russo, Anthony Russo',
                    'rating'      => '9.3'
                    );

        $data[] = array(
                    'id'          => 2,
                    'title'       => 'Fast And Furious',
                    'description' => 'A series of action films that are largely concerned with illegal street racing, heists and spies',
                    'year'        => '2001',
                    'director'    => 'Vin Diesel, Justin Lin, etc',
                    'rating'      => '9.2'
                    );

        $data[] = array(
                    'id'          => 3,
                    'title'       => 'Deadpool',
                    'description' => 'Deadpool is a American superhero film based on the Marvel Comics character of the same name.',
                    'year'        => '2016',
                    'director'    => 'Tim Miller',
                    'rating'      => '9.0'
                    );

        $data[] = array(
                    'id'          => 4,
                    'title'       => 'Insidious',
                    'description' => 'The story centers on a couple whose son inexplicably enters a comatose state and becomes a vessel for ghosts in an astral dimension who want to inhabit his body.',
                    'year'        => '2010',
                    'director'    => 'James Wan',
                    'rating'      => '9.0'
                    );

        $data[] = array(
                    'id'          => 5,
                    'title'       => 'Passengers',
                    'description' => 'A spacecraft traveling to a distant colony planet and transporting thousands of people has a malfunction in its sleep chambers. As a result, two passengers are awakened 90 years early.',
                    'year'        => '2016',
                    'director'    => 'Morten Tyldum',
                    'rating'      => '9.0'
                    );

        $data[] = array(
                    'id'          => 6,
                    'title'       => 'Suicide Squad',
                    'description' => 'A secret government agency led by Amanda Waller recruits imprisoned supervillains to execute dangerous black ops missions and save the world from a powerful threat in exchange for reduced sentences.',
                    'year'        => '2016',
                    'director'    => 'David Ayer',
                    'rating'      => '9.0'
                    );

        $data[] = array(
                    'id'          => 7,
                    'title'       => 'Martian',
                    'description' => 'An astronaut becomes stranded on Mars after his team assume him dead, and must rely on his ingenuity to find a way to signal to Earth that he is alive.',
                    'year'        => '2015',
                    'director'    => 'Ridley Scott',
                    'rating'      => '8.9'
                    );

        $data[] = array(
                    'id'          => 8,
                    'title'       => 'Unstoppable',
                    'description' => 'It is loosely based on the real-life CSX 8888 incident, telling the story of a runaway freight train and the two men who attempt to stop it.',
                    'year'        => '2010',
                    'director'    => 'Tony Scott',
                    'rating'      => '8.9'
                    );

        $data[] = array(
                    'id'          => 9,
                    'title'       => 'Now you see me',
                    'description' => 'An F.B.I. Agent and an Interpol Detective track a team of illusionists who pull off bank heists during their performances, and reward their audiences with the money.',
                    'year'        => '2013',
                    'director'    => 'Louis Leterrier',
                    'rating'      => '8.9'
                    );

        $data[] = array(
                    'id'          => 10,
                    'title'       => 'Captain America',
                    'description' => 'Steve Rogers, a rejected military soldier, transforms into Captain America after taking a dose of a "Super-Soldier serum". But being Captain America comes at a price as he attempts to take down a war monger and a terrorist organization.',
                    'year'        => '2011',
                    'director'    => 'Joe Russo, Anthony Russo, Joe Johnston',
                    'rating'      => '8.8'
                    );

        return $data;
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    
    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'id':
            case 'title':
            case 'description':
            case 'year':
            case 'director':
            case 'rating':
                return $item[ $column_name ];

            default:
                return print_r( $item, true ) ;
        }
    }
     
    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'title';
        $order = 'asc';   // asc - ascending order

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }


        $result = strcmp( $a[$orderby], $b[$orderby] );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }
}
?>
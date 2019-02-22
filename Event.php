<?php
    include 'DBconnect.php';
    class Event
    {
        private $id;
        private $title;
        private $desc;
        private $author;
        private $createdOn;
        protected $dbConn;
        protected $connection;
        private $lastThree = [];

        public function __construct()
        {
            $this->dbConn = new DBconnect();
            $this->connection = $this->dbConn->connect();

        }


        function setId($id)
        {
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function setTitle($title)
        {
            $this->title = $title;
        }

        function getTitle()
        {
            return $this->title;
        }

        function setDesc($description)
        {
            $this->desc = $description;
        }

        function getDesc()
        {
            return $this->desc;
        }

        function setAuthor($author)
        {
            $this->author = $author;
        }

        function getAuthor()
        {
            return $this->author;
        }

        function setCreatedOn($createdOn)
        {
            $this->createdOn = $createdOn;
        }

        function getCreatedOn()
        {
            return $this->createdOn;
        }


        public function save()
        {
            try{

                $data =[
                    'title' => $this->title,
                    'descp' => $this->desc,
                    'author' => $this->author,
                    'cdate' => $this->createdOn,
                ];
                $sql = "INSERT INTO HACKATHON (title, description, author, createdOn) VALUES (:title, :descp, :author, :cdate)";
                $statement = $this->dbConn->prepare($sql);
                $statement->execute($data);
            }catch(PDOExecution $e){
                die("<br><br><br><br><br><br><br><br>SQL INSERT GICK INTE:" . $e->getMessage(). "<br>");
                print_r($sth->errorInfo());
            }
        }

        ///
        public function fetchPosts(){
            try{
                $this->LastThree = $this->connection->query("SELECT * FROM EVENTS ORDER BY ID")->fetchAll();
		$output = '{
			"type": "FeatureCollection",
				"features": [';
		foreach($this->LastThree as $key => $value){
		/*
                    echo "<div class='card' style='width: 18rem;'>
                        <div class='card-body'>
                            <h5 class='card-title'>" .$value[9] ."</h5>
                            <h6 class='card-subtitle mb-2 text-muted'>Card subtitle</h6>
                            <p class='card-text'>" .$value[9] ."</p>
                            <a href='#' class='card-link'" .$value[2] ."</a>
                            <a href='#' class='card-link'>Another link</a>
                        </div>
			</div>";*/
			$output .= 
				'{
					"type": "Feature",
					"geometry": {
						"type": "Point",
						"coordinates": [
							"' . $value[11] 
							. '", "' . $value[10] 
							. '"]
							},
						"properties": {
						"phoneFormatted":"' . $value[12] .'",
						"phone":"' . $value[12] . '",
						"event":"' . $value[9] . '",
						"address":"' . $value[2] . '",
						"city":"' . $value[3] . '",
						"country":"' . $value[5] . '",
						"postalCode": "' . $value[4] . '"
						}
				},';

						

		}

		$output .= 'null]}';

		echo $output;

            }catch(PDOException $e){
                die("SQL query gick ej: " . $e->getMessage());
            }
        }
    }

?>

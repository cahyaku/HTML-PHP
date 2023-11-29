<?php
//
//namespace App\Repository;
//
//use App\Entity\Vehicles;
//use App\Helper\JsonHelper;
//
////use VehiclesRepository;
//
//class JsonVehiclesRepository extends BaseRepository implements VehiclesRepository
//{
//    private static $instance = null;
//
//    private function __construct()
//    {
//    }
//
//    public static function getInstance()
//    {
//        if (self::$instance == null) {
//            self::$instance = new JsonVehiclesRepository();
//        }
//        return self::$instance;
//    }
//
//    public function countAll(): int
//    {
//        return count($this->getAll());
//    }
//
//    public function save(Vehicles $vehicles): null|Vehicles
//    {
//        $vehiclesData = $this->getAll();
//        if ($vehicles->getId() == null) {
//            $id = BaseRepository::generateId($this->getAll());
//            $vehicles->setId($id);
//            $vehiclesData[] = $vehicles;
//
//            JsonHelper::saveDataIntoJson($vehiclesData, "vehicles.json");
//        } else {
//            for ($i = 0; $i < count($vehiclesData); $i++) {
//                if ($vehiclesData[$i]->getId() == $vehicles->getId()) {
//                    $vehiclesData[$i]->setBrand($vehicles->getBrand());
//                    $vehiclesData[$i]->setModel($vehicles->getModel());
//                    $vehiclesData[$i]->setType($vehicles->getType());
//                    JsonHelper::saveDataIntoJson($vehiclesData, "vehicles.json");
//                }
//            }
//        }
//        return null;
//    }
//
//    public function remove(int $id): bool
//    {
//        $vehicles = $this->getAll();
//        for ($i = 0; $i < sizeof($vehicles); $i++) {
//            if ($id == $vehicles[$i]->getId()) {
//                unset ($vehicles[$i]);
//                $vehicles = array_values($vehicles);
//                JsonHelper::saveDataIntoJson($vehicles, "vehicles.json");
//                return true;
//            }
//        }
//        return false;
//    }
//
//    public function search(string $input): array
//    {
//        $vehicles = $this->getAll();
//        $searchResult = [];
//        foreach ($vehicles as $vehicle => $value) {
//            if (preg_match("/$input/i", $value->getBrand())) {
//                if (in_array($value->getBrand(), $searchResult) == false) {
//                    $searchResult[] = $value;
//                }
//            }
//            if (preg_match("/$input/i", $value->getModel())) {
//                if (in_array($value->getModel(), $searchResult) == false) {
//                    $searchResult[] = $value;
//                }
//            }
//        }
//        return $searchResult;
//    }
//
//    public function getAll(): array
//    {
//        $vehicles = JsonHelper::loadDataFromJson("vehicles.php");
//        $result = [];
//        foreach ($vehicles as $key => $value) {
//            $vehicle = new Vehicles();
////            $vehicle->setId($value['id']);
//            $vehicle->setBrand($value['brand']);
//            $vehicle->setModel($value['model']);
//            $vehicle->setType($value['type']);
//            $result[] = $vehicle;
//        }
//        // ini untuk meng-append this->vehicle = $result;
//        $vehicle = $result;
//        return $vehicle;
//
////        // ini mencoba jika datanya langsung di return
////        // belum dicoba!!!
////        return $result;
//    }
//}
//
//

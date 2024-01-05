<?php

session_start();
$conn = "";
$stmt = "";

function connectToDB()
{
    $username = "root";
    $password = "";

    $dataSourceName = "mysql:host=localhost;dbname=perpusku";
    try{
        $conn = new PDO($dataSourceName, $username, $password);
        return $conn;
    }
    catch(PDOException $e){
        echo $e->getMessage();
        return null;
    }
}

connectToDB();

function closeConnection(){

    $conn = null;
    $stmt = null;

}
function fetchAllMembers(){

    $conn = connectToDB();
    if(!$conn){
        return null;
    }

    $stmt = $conn->query("SELECT * FROM TMember");
    $members = [];

    while($member = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($member == NULL){
            break;
        }
        array_push($members, $member);
    }

    closeConnection();
    return $members;
}

function fetchAllBooks(){

    $conn = connectToDB();
    if(!$conn){
        return null;
    }

    $stmt = $conn->query("SELECT * FROM TBuku");
    $books = [];

    while($book = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($book == NULL){
            break;
        }
        array_push($books, $book);
    }

    closeConnection();
    return $books;
}

function fetchAllBookings(){

    $conn = connectToDB();
    if(!$conn){
        return null;
    }

    $stmt = $conn->query("SELECT * FROM TMeminjam NATURAL JOIN TBuku NATURAL JOIN TMember");
    $bookings = [];

    while($booking = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($booking == NULL){
            break;
        }
        array_push($bookings, $booking);
    }

    closeConnection();
    return $bookings;
}

function addBook($data){

    $conn = connectToDB();
    $stmt = $conn->prepare("INSERT INTO TBuku (IDBuku, JudulBuku, Genre, TahunTerbit) VALUES (?, ?, ?, ?)");
    
    $stmt -> execute([
        $data["IDBuku"],
        $data["JudulBuku"],
        $data["Genre"],
        $data["TahunTerbit"],
    ]);

    closeConnection();
}

function addMember($data){

    $conn = connectToDB();
    $stmt = $conn->prepare("INSERT INTO TMember (IDMember, NamaMember, NoTelpon, TanggalLahir) VALUES (?, ?, ?, ?)");
    
    $stmt -> execute([
        $data["IDMember"],
        $data["NamaMember"],
        $data["NoTelpon"],
        $data["TanggalLahir"],
    ]);
    
    closeConnection();
}

function addBooking($data){

    $conn = connectToDB();
    $stmt = $conn->prepare("INSERT INTO TMeminjam (IDMember, IDBuku, TanggalPeminjaman, TanggalPengembalian) VALUES (?, ?, ?, ?)");
    
    $stmt -> execute([
        $data["IDMember"],
        $data["IDBuku"],
        $data["TanggalPeminjaman"],
        $data["TanggalPengembalian"],
    ]);
    
    closeConnection();
}

function getDataByIDMember($data)
{
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM TMember WHERE IDMember = ?");

    $stmt -> execute([
        $data["IDMember"],
    ]);

    $member = $stmt->fetch();
    closeConnection();
    return $member;
}

function updateMember($data){
    $conn = connectToDB();
    $stmt = $conn->prepare("UPDATE TMember SET NamaMember = ?, NoTelpon = ?, TanggalLahir= ? WHERE IDMember = ?");
    $stmt -> execute([
        $data["NamaMember"],
        $data["NoTelpon"],
        $data["TanggalLahir"],
        $data["IDMember"], 
    ]);
    closeConnection();
}

function getDataByIDBook($data)
{
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM TBuku WHERE IDBuku = ?");

    $stmt -> execute([
        $data["IDBuku"],
    ]);

    $book = $stmt->fetch();
    closeConnection();
    return $book;
}

function updateBook($data){
    $conn = connectToDB();
    $stmt = $conn->prepare("UPDATE TBuku SET JudulBuku = ?, Genre = ?, TahunTerbit= ? WHERE IDBuku = ?");
    $stmt -> execute([
        $data["JudulBuku"],
        $data["Genre"],
        $data["TahunTerbit"],
        $data["IDBuku"], 
    ]);
    closeConnection();
}

function getDataByIDBooking($data)
{
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM TMeminjam WHERE IDBuku = ? AND IDMember = ?");

    $stmt -> execute([
        $data["IDBuku"],
        $data["IDMember"],
    ]);

    $booking = $stmt->fetch();
    closeConnection();
    return $booking;
}

function getDataByIDBookingOnlyBook($data)
{
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM TMeminjam WHERE IDBuku = ?");

    $stmt -> execute([
        $data["IDBuku"],
    ]);

    $bookings = [];

    while($booking = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($booking == NULL){
            break;
        }
        array_push($bookings, $booking);
    }

    closeConnection();
    return $bookings;
}

function getDataByIDBookingOnlyMember($data)
{
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM TMeminjam WHERE IDMember = ?");

    $stmt -> execute([
        $data["IDMember"],
    ]);

    $bookings = [];

    while($booking = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($booking == NULL){
            break;
        }
        array_push($bookings, $booking);
    }

    closeConnection();
    return $bookings;
}

function updateBooking($data){
    $conn = connectToDB();
    $stmt = $conn->prepare("UPDATE TMeminjam SET TanggalPeminjaman = ?, TanggalPengembalian = ? WHERE IDBuku = ? AND IDMember = ?");
    $stmt -> execute([
        $data["TanggalPeminjaman"],
        $data["TanggalPengembalian"],
        $data["IDBuku"],
        $data["IDMember"], 
    ]);
    closeConnection();
}

function deleteBook($data){
    print_r($data);
    $conn = connectToDB();

    $stmt = $conn->prepare("DELETE FROM TBuku WHERE IDBuku = ?");
    $stmt -> execute([
        $data["IDBuku"], 
    ]);
    closeConnection();
}

function deleteMember($data){
    print_r($data);
    $conn = connectToDB();

    $stmt = $conn->prepare("DELETE FROM TMember WHERE IDMember = ?");
    $stmt -> execute([
        $data["IDMember"], 
    ]);
    closeConnection();
}

function deleteBooking($data){
    print_r($data);
    $conn = connectToDB();

    $stmt = $conn->prepare("DELETE FROM TMeminjam WHERE IDBuku = ? AND IDMember = ?");
    $stmt -> execute([
        $data["IDBuku"],
        $data["IDMember"], 
    ]);
    closeConnection();
}

function getDataByGenre($data)
{
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM TBuku WHERE Genre = ?");

    $stmt -> execute([
        $data["Genre"],
    ]);

    $books = [];

    while($book = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($book == NULL){
            break;
        }
        array_push($books, $book);
    }

    closeConnection();
    return $books;
}

function getDataByTitle($data)
{
    $conn = connectToDB();
    $variable = $data["JudulBuku"];
    $stmt = $conn->query("SELECT * FROM TBuku WHERE JudulBuku LIKE '%".$variable."%'");

    $books = [];

    while($book = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($book == NULL){
            break;
        }
        array_push($books, $book);
    }

    closeConnection();
    return $books;
}

function getDataByMemberName($data)
{
    $conn = connectToDB();
    $variable = $data["NamaMember"];
    $stmt = $conn->query("SELECT * FROM TMember WHERE NamaMember LIKE '%".$variable."%'");
    $members = [];

    while($member = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($member == NULL){
            break;
        }
        array_push($members, $member);
    }

    closeConnection();
    return $members;
}

?>


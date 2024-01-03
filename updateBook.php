<?php
    require_once "database.php";
    $book = [];
    if(isset($_POST["inputBtn"])){
        $book = getDataByIDBook($_POST);
    }
    if(isset($_POST["updateBtn"])){
        updateBook($_POST);
        header("Location: show.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<body class="text-gray-800 font-inter">
    
    <!-- start: Sidebar -->
    <div class="fixed left-0 top-0 w-64 h-full bg-gray-900 p-4 z-50 sidebar-menu transition-transform">
        <a href="pengpustakaan.png" class="flex items-center pb-4 border-b border-b-gray-800">
            <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded object-cover">
            <span class="text-lg font-bold text-white ml-3">Pengpustakaan</span>
        </a>
        <ul class="mt-4">
            <li class="mb-1 group">
                <a href="index.php" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Member</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="input.php" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <i class="ri-instance-line mr-3 text-lg"></i>
                    <span class="text-sm">Input</span>
                </a>
            </li>
            <li class="mb-1 group active">
                <a href="update.php" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <i class="ri-flashlight-line mr-3 text-lg"></i>
                    <span class="text-sm">Update</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="show.php" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-settings-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Show</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    <!-- end: Sidebar -->

    <!-- start: Main -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        <div class="py-2 px-6 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
            <button type="button" class="text-lg text-gray-600 sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>
            <ul class="flex items-center text-sm ml-4">
                <li class="mr-2">
                    <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                </li>
                <li class="text-gray-600 mr-2 font-medium">/</li>
                <li class="text-gray-600 mr-2 font-medium">Update Data</li>
            </ul>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 gap-6 mb-6">
                <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                    <div class="flex justify-between mb-4 items-start">
                        <div class="font-medium">Update Book</div>
                    </div>
                    <div class="overflow-x-auto">
                        <form action="" method="POST">
                            <label for="IDBuku">Book ID</label>
                            <input type="text" pattern="B[0-9]{3}" maxlength="4" name="IDBuku" style="border: 2px solid black; margin: 10px; required"> <br><br>
                            <button type="submit" name="inputBtn" style="border-radius: 10px; width: 200px; height: 40px; background-color: #111827 ; color: white;">Submit</button>
                        </form>
                        <?php if($book != NULL){ ?>
                            <br><br>
                            <table class="w-full min-w-[540px]" data-tab-for="order" data-page="active">
                            <thead>
                                <tr>
                                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">Book ID</th>
                                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">Judul Buku</th>
                                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">Genre</th>
                                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">Tahun Terbit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <div class="flex items-center">
                                            <a href="#" class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate"><?= $book['IDBuku'] ?></a>
                                        </div>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="text-[13px] font-medium text-gray-400"><?= $book['JudulBuku'] ?></span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="text-[13px] font-medium text-gray-400"><?= $book['Genre'] ?></span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="text-[13px] font-medium text-gray-400"><?= $book['TahunTerbit'] ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php if($book != NULL){ ?>
                <div class="grid grid-cols-1 gap-6 mb-6">
                    <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                        <div class="flex justify-between mb-4 items-start">
                            <div class="font-medium">Update <?= $book["IDBuku"] ?></div>
                        </div>
                        <div class="overflow-x-auto">
                            <form action="" method="POST">
                                <label for="IDBuku">Book ID</label>
                                <input type="text" value="<?=$book["IDBuku"]?>" readonly placeholder="<?=$book["IDBuku"];?>" name="IDBuku" style="border: 2px solid black; margin: 10px; required"> <br>
                                <label for="JudulBuku">Judul Buku</label>
                                <input type="text" maxlength="20" name="JudulBuku" style="border: 2px solid black; margin: 10px; required"><br>
                                <label for="Genre">Genre</label>
                                <input type="text" maxlength="20" name="Genre" style="border: 2px solid black; margin: 10px; required"><br>
                                <label for="TahunTerbit">Tahun Terbit</label>
                                <input type="number" min="1600" max="2023" name="TahunTerbit" style="border: 2px solid black; margin: 10px; required"><br><br>
                                <button type="submit" name="updateBtn" style="border-radius: 10px; width: 200px; height: 40px; background-color: #111827 ; color: white;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    <!-- end: Main -->

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="dist/js/script.js"></script>
    <script type="text/javascript">
        function nextpage(select){
            window.location = select.value;
        }
    </script>
</body>
</html>
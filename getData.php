

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pie Charts by Region</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            width: 400px !important;
            height: 400px !important;
            
        }
    </style>
</head>
<body>
<h1>地域別回答者年齢構成</h1>    

    <div id="upper">
        <div>
            <canvas id="chartHokkaido"></canvas>
        </div>
        <div>
            <canvas id="chartTohoku"></canvas>
        </div>
        <div>
            <canvas id="chartKanto"></canvas>
        </div>
    </div>
    <div id="lower">
        <div>
            <canvas id="chartKansai"></canvas>
        </div>
        <div>
            <canvas id="chartShikoku"></canvas>
        </div>
        <div>
            <canvas id="chartKyushu"></canvas>
        </div>
    </div>


    <!-- 他の地域も同様に追加できます -->

    <?php
    // データを読み込む
    $dataFilePath = 'data/data.txt';
    $data = [];
    
    // ファイルが存在するか確認
    if (file_exists($dataFilePath)) {
        // ファイルを読み込み、行ごとに処理
        $fileContents = file($dataFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($fileContents as $line) {
            // 行を全角スペースで分割
            $parts = preg_split('/\s+/u', $line);
            if (count($parts) === 4) {
                $datetime = $parts[0] . ' ' . $parts[1];
                $ageGroup = $parts[2];
                $region = $parts[3];
                $data[] = ['date' => $datetime, 'ageGroup' => $ageGroup, 'region' => $region];
            }
        }
    }
    
    // データをJSON形式にエンコード
    $jsonData = json_encode($data);
    ?>







    <script>
        // PHPから渡されたデータをJavaScriptの変数に格納
        const data = <?php echo $jsonData; ?>;

        function getCountsByRegion(data, region) {
            const counts = {};
            const ageGroups = ["-20", "20-29", "30-39", "40-49", "50-59", "60-69", "70-79", "80-"];
            ageGroups.forEach(age => counts[age] = 0);

            data.forEach(entry => {
                if (entry.region === region) {
                    counts[entry.ageGroup]++;
                }
            });

            return counts;
        }

        function createPieChart(canvasId, region, data) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            const counts = getCountsByRegion(data, region);
            const ageGroups = ["-20", "20-29", "30-39", "40-49", "50-59", "60-69", "70-79", "80-"];

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ageGroups,
                    datasets: [{
                        data: ageGroups.map(age => counts[age]),
                        backgroundColor: [
                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                            '#9966FF', '#FF9F40', '#FFCD56', '#C9CBCF'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: `Age Distribution in ${region}`
                        }
                    }
                }
            });
        }

        // ページロード時にグラフを初期化
        window.onload = function() {
            createPieChart('chartHokkaido', 'Hokkaido', data);
            createPieChart('chartTohoku', 'Tohoku', data);
            createPieChart('chartKanto', 'Kanto', data);
            createPieChart('chartKansai', 'Kansai', data);
            createPieChart('chartShikoku', 'Shikoku', data);
            createPieChart('chartKyushu', 'Kyushu', data);
            // 他の地域も同様に追加します
        };
    </script>
</body>
</html>
<html lang="en">

<head>
    <script type="module" crossorigin src="http://localhost:3000/@@vite/client"></script>
    <script type="module" crossorigin src="http://localhost:3000/resources/js/app.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donkeyquiz</title>
</head>
<header class="lg:pl-20 lg:pt-8">
    <logo id="logodiv" class="flex-wrap lg:inline-block">
        <image id="logo" src="images/logo.svg" class="flex mt-2 lg:inline-block w-12 h-14 lg:w-24 lg:h-28 m-auto"></image>
        <logofont id="logoFont" class="text-center mt-4 lg:text-left font-poppins font-semibold text-24 leading-normal text-donkeytext">
            <p>donkeyquiz</p>
        </logofont>
    </logo>
</header>

<body id="body" class="bg-donkeywhite">
    <blobRight class="absolute top-20 right-0">
        <image id="blobRight" src="images/blobright.svg" class="float-right w-4/12 sm:w-6/12 md:w-8/12 xl:w-10/12 2xl:w-full"></image>
    </blobRight>

    <div id="quizContent" class="mt-8 sm:mt-2 md:mt-4 flex justify-center items-center h-auto sm:h-1/2 w-3/5 max-w-screen-2xl m-auto">
        <div id="page" class="font-poppins text-center">
            <h3 id="category" class="mt-0 w-auto text-14 leading-normal text-donkeyblue font-semibold"></h3>
            <h2 id="content" class="border-2 inline-block mt-4 md:mt-6 lg:mt-8 font-semibold text-20 lg:text-36 xl:text-48  text-donkeytext"></h2>
            <p id="subtext" class="mt-2 md:mt-6 font-normal text-12 md:text-14 lg:text-16 text-donkeydarkblue "></p>
            <div id="categoryResult" class="m-0 p-0 md:mt-10 xl:mt-16"></div>
            <div id="buttons" class="mt-4 md:mt-6 xl:mt-8">
                <div id="button1" class="inline-flex"></div>
                <div id="button2" class="inline-flex"></div>
            </div>
        </div>
    </div>


    <div id="progressbar" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 -translate-y-1/2  font-poppins justify-center items-center w-3/5 max-w-screen-2xl m-auto">
        <div id="progressborder"></div>
        <button id="progressbutton"></button>
        <p id="progresstext" class="mt-2 md:mt-8 font-normal text-center text-16 text-donkeydarkblue"></p>
    </div>

    <script>
        apiUrl = './questions.json';

        let currentQuestion = 0;
        let jsonData = [];
        let questions = [];
        let correctAnswers = {
            'Musik': 0,
            'Vetenskap': 0,
            'Geografi': 0,
            'Film & TV': 0,
            'Sport': 0,
            'Övrigt': 0,
            'Historia': 0
        };

        document.getElementById("content").innerHTML = "Svensk mästare i TP?";
        document.getElementById("subtext").innerHTML = "Utmana vänner, kollegor och familj på frågesport. Svara på 35 samtida frågor i 7 olika kategorier.";
        document.getElementById("button1").innerHTML = '<button onclick="startQuiz()" class="border-2 mt-10 mx-5 px-8 py-4 font-poppins bg-blue-400 text-donkeyblue hover:bg-donkeyblue hover:text-donkeywhite font-bold py-2 px-4 rounded-full">Klicka här för att starta</button>';

        function startQuiz() {

            let request = new XMLHttpRequest();
            request.open("GET", apiUrl, false);
            request.send(null);
            jsonData = JSON.parse(request.responseText);

            function addQuestions(categoryName) {
                let i = Math.floor(Math.random() * (result.length + 1))
                console.log(i);
            }

            let getCategoryQuestions = function(sourceArray, neededElements, categoryName) {
                const tempFilter = sourceArray.filter(({
                    category
                }) => category === categoryName);
                let result = [];
                for (let i = 0; i < neededElements; i++) {
                    result.push(tempFilter[Math.floor(Math.random() * tempFilter.length)]);
                }
                return result;
            }

            questions = questions.concat(getCategoryQuestions(jsonData, 5, 'Vetenskap'),
                getCategoryQuestions(jsonData, 5, 'Historia'),
                getCategoryQuestions(jsonData, 5, 'Film & TV'),
                getCategoryQuestions(jsonData, 5, 'Musik'),
                getCategoryQuestions(jsonData, 5, 'Geografi'),
                getCategoryQuestions(jsonData, 5, 'Övrigt'),
                getCategoryQuestions(jsonData, 5, 'Sport'));

            questions.sort(function() {
                return .5 - Math.random()
            });
            zoomInGiveQuestion();
        }

        function zoomInGiveQuestion() {
            document.getElementById("quizContent").className = 'animate-zoomout1 mt-8 sm:mt-2 md:mt-4 flex justify-center items-center h-auto sm:h-1/2 w-3/5 max-w-screen-2xl m-auto';
            document.getElementById("quizContent").addEventListener("animationend", (event) => giveQuestion())
        }

        function giveQuestion() {
            document.getElementById("quizContent").removeEventListener("animationend", zoomInGiveQuestion);
            let page = document.getElementById("logo").src = "images/logo.svg";
            document.getElementById("logo").src = "images/logo.svg";
            document.getElementById("logo").src = "images/logo.svg";
            let blobRight = document.getElementById("blobRight");
            blobRight.className = "h-auto float-right w-4/12 sm:w-6/12 md:w-8/12 xl:w-10/12 2xl:w-full";
            let blobLeft = document.getElementById("blobLeft");
            blobLeft.className = "h-auto float:left w-4/12 sm:w-6/12 md:w-8/12 xl:w-10/12 2xl:w-full";
            document.getElementById("body").style.backgroundColor = "#F5F5F5";
            document.getElementById("logoFont").style.color = '#000064';
            document.getElementById("category").style.color = '#7678ED';
            document.getElementById("content").style.color = '#000064';
            document.getElementById("category").innerHTML = questions[currentQuestion].category;
            document.getElementById("content").innerHTML = questions[currentQuestion].question;
            document.getElementById("subtext").innerHTML = "";
            document.getElementById("button1").innerHTML = '<button onclick="zoomInseeAnswer()" class="mx-5 py-2 px-4 font-poppins border-2 bg-blue-400 text-donkeyblue hover:bg-donkeyblue hover:text-donkeywhite font-bold rounded-full">Se svaret</button>';
            document.getElementById("button2").innerHTML = '';
            document.getElementById("progressbutton").className = 'relative h-4 p-0 m-0 w-28 bg-blue-4 bg-donkeytext rounded-full';
            document.getElementById("progressbutton").style = 'left:' + (currentQuestion * 2.94) + '%';
            document.getElementById("progressborder").classList = 'relative top-2 p-0 m-0 border border-donkeyblue w-full';
            document.getElementById("progresstext").classList = 'mt-2 md:mt-8 font-normal text-center text-16 text-donkeydarkblue';
            let questionString = 1 + currentQuestion;
            document.getElementById("progresstext").innerHTML = 'Fråga ' + questionString + ' av 35';
            document.getElementById("quizContent").className = 'animate-zoomin1 mt-8 sm:mt-2 md:mt-4 flex justify-center items-center h-auto sm:h-1/2 w-3/5 max-w-screen-2xl m-auto';
        }

        function zoomInseeAnswer() {
            document.getElementById("quizContent").className = 'animate-zoomout1 mt-8 sm:mt-2 md:mt-4 flex justify-center items-center h-auto sm:h-1/2 w-3/5 max-w-screen-2xl m-auto';
            document.getElementById("quizContent").addEventListener("animationend", (event) => seeAnswer())

        }

        function seeAnswer() {
            document.getElementById("quizContent").removeEventListener("animationend", zoomInseeAnswer);
            document.getElementById("logo").src = "images/logoInvert.svg";
            let blobRight = document.getElementById("blobRight");
            blobRight.className += "invert brightness-0 invert";
            let blobLeft = document.getElementById("blobLeft");
            blobLeft.className += "invert brightness-0 invert";
            document.getElementById("body").style.backgroundColor = "#7678ED";
            document.getElementById("logoFont").style.color = 'white';
            document.getElementById("category").style.color = 'white';
            document.getElementById("category").innerHTML = 'Rätt svar:';
            document.getElementById("content").style.color = "#00FFC4";
            document.getElementById("content").innerHTML = questions[currentQuestion].answer;
            document.getElementById("subtext").innerHTML = '<h3 id="" class="text-14 text-white leading-normal font-semibold">Svarade du rätt?</h3>';
            document.getElementById("button1").innerHTML = '<button onclick="checkAnswer(true)" class="mx-5 px-8  py-2 px-4 font-poppins border-2 bg-blue-400 text-white hover:bg-white hover:text-donkeyblue font-bold  rounded-full">Ja</button>';
            document.getElementById("button2").innerHTML = '<button onclick="checkAnswer(false)" class="mx-5 px-8 py-2 px-4 font-poppins border-2 bg-blue-400 text-white hover:bg-white hover:text-donkeyblue font-bold rounded-full">Nej</button>';
            document.getElementById("progressbutton").className = 'relative h-4 p-0 m-0 w-28 bg-blue-4 bg-white rounded-full';
            document.getElementById("progressborder").classList = 'relative top-2 p-0 m-0 border border-white w-full';
            document.getElementById("progresstext").classList = 'mt-2 md:mt-8 font-normal text-center text-16 text-white';
            document.getElementById("quizContent").className = 'animate-zoomin2 mt-8 sm:mt-2 md:mt-4 flex justify-center items-center h-auto sm:h-1/2 w-3/5 max-w-screen-2xl m-auto';
        }

        function checkAnswer(yesNo) {
            if (yesNo) {
                correctAnswers[questions[currentQuestion].category]++;
                console.log(correctAnswers);
            }
            if (currentQuestion >= 4) {
                document.getElementById("quizContent").removeEventListener("animationend", zoomInseeAnswer);
                document.getElementById("quizContent").removeEventListener("animationend", zoomInGiveQuestion);
                zoomInshowResults();
            } else {
                currentQuestion++;
                zoomInGiveQuestion();
            }
        }

        function zoomInshowResults() {
            document.getElementById("quizContent").className = 'animate-zoomout1 mt-8 sm:mt-2 md:mt-4 flex justify-center items-center h-auto sm:h-1/2 w-3/5 max-w-screen-2xl m-auto';
            document.getElementById("quizContent").addEventListener("animationend", (event) => showResults())
        }

        function showResults() {

            categoryResult();
            let totalPoints = Object.values(correctAnswers).reduce(
                (previousValue, currentValue) => previousValue + currentValue, 0
            );
            document.getElementById("logo").src = "images/logo.svg";
            let blobRight = document.getElementById("blobRight");
            blobRight.className = "h-auto float-right w-4/12 sm:w-6/12 md:w-8/12 xl:w-10/12 2xl:w-full";
            let blobLeft = document.getElementById("blobLeft");
            blobLeft.className = "h-auto float-left w-4/12 sm:w-6/12 md:w-8/12 xl:w-10/12 2xl:w-full";
            document.getElementById("body").style.backgroundColor = "#F5F5F5";
            document.getElementById("logoFont").style.color = '#000064';
            document.getElementById("category").style.color = '#7678ED';
            document.getElementById("content").style.color = '#000064';
            document.getElementById("category").innerHTML = 'Ditt resultat';
            document.getElementById("category").innerHTML = 'Ditt resultat';
            document.getElementById("content").innerHTML = totalPoints + ' av 35 rätt';

            document.getElementById("subtext").className = "";
            document.getElementById("subtext").innerHTML = "";
            document.getElementById("categoryResult").className = "border-2 sm:-mt-10 md:mt-0 flex scale-50 sm:scale-60 md:scale-80 lg:scale-100";
            document.getElementById("categoryResult").innerHTML = categoryResult();
            document.getElementById("button1").innerHTML = "";
            document.getElementById("button1").className = "";
            document.getElementById("button2").innerHTML = '<button onclick="again()" class="mt-2 sm:-mt-10 md:-mt-4 lg:mt-10 mx-5 px-8 py-4 font-poppins border-2 bg-blue-400 text-donkeyblue hover:bg-donkeyblue hover:text-donkeywhite font-bold py-2 px-4 rounded-full">En runda till?</button>';
            document.getElementById("progresstext").innerHTML = "";
            document.getElementById("progressbutton").className = "";
            document.getElementById("progressborder").className = "";
            document.getElementById("quizContent").className = 'animate-zoomin2 mt-8 sm:mt-2 md:mt-4 flex justify-center items-center h-auto sm:h-1/2 w-3/5 max-w-screen-2xl m-auto';
        }

        function addSVG(color) {
            let svg = '<svg class = "w-12 h-10 inline-block mt-2"><rect width = "40px" height = "32px" rx = "15px" fill = "' + color + '"' + '/></svg>';
            return svg;
        }

        function categoryResult() {

            let answers = Object.values(correctAnswers);
            let categoryName = Object.keys(correctAnswers);
            console.log(answers);
            let category = "";
            for (let i = 0; i < answers.length; i++) {
                category = category + '<div id="' + i + '" class="w-20 inline-block">';
                console.log(answers[i]);

                for (let j = 5; j > 0; j--) {
                    if (j > answers[i]) {
                        category = category + addSVG("#EEEEEE");
                    } else {
                        category = category + addSVG("#00FFC4");
                        console.log(category);
                    }
                }
                category = category + ' <h3 id = "categoryName" class = "inline-block text-14 mt-4 text-donkeyblue leading-normal font-semibold">' + categoryName[i] + '</h3> </div>';
            }
            console.log(category);
            return category
        }

        function again() {
            window.location.replace("http://localhost");
        }
    </script>



    <blobLeft class="absolute bottom-20">
        <image id="blobLeft" src="images/blobleft.svg" class="float-left w-4/12 sm:w-6/12 md:w-8/12 xl:w-10/12 2xl:w-full"></image>
    </blobLeft>
</body>

</html>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>인사 평가 정보</title>
    <link rel="stylesheet" href="evaluation_styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>인사 평가 정보</h2>
        <div class="search-container">
            <input type="text" id="search" placeholder="구성원 이름 검색...">
            <button onclick="searchEvaluation()">검색</button>
        </div>
        <div class="list-container" id="evaluation-list">
            <!-- 평가 목록이 여기에 표시됩니다 -->
        </div>

        <div class="button-container">
            <button type="button" onclick="openAddEvaluationForm()">새 평가 추가</button>
        </div>
        <div class="tohome">
       
    </div>

    <!-- 수정 모달 -->
    <div id="edit-form" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditForm()">&times;</span>
            <h2>평가 정보 수정하기</h2>
            <form id="edit-evaluation-form">
                <input type="hidden" id="edit-index">
                <label for="edit-emp-no" >구성원 번호:</label>
                <input type="text" id="edit-emp-no" required readonly><br>
                <label for="edit-name" >이름:</label>
                <input type="text" id="edit-name" required readonly><br>
                <label for="edit-year">평가 연도:</label>
                <input type="text" id="edit-year" required readonly><br>
                <label for="edit-achievement">성취도:</label>
                <input type="text" id="edit-achievement" required><br>
                <label for="edit-leadership">리더십:</label>
                <input type="text" id="edit-leadership" required><br>
                <label for="edit-teamwork">팀워크:</label>
                <input type="text" id="edit-teamwork" required><br>
                <label for="edit-problem-solving">문제 해결 능력:</label>
                <input type="text" id="edit-problem-solving" required><br>
                <label for="edit-communication">의사소통 능력:</label>
                <input type="text" id="edit-communication" required><br>
                <button type="button" onclick="saveEvaluationInfo()">저장하기</button>
            </form>
        </div>
    </div>

    <!-- 추가 모달 -->
    <div id="add-form" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddForm()">&times;</span>
            <h2>새 평가 추가하기</h2>
            <form id="add-evaluation-form" action="evaluation_register.php" method="POST">
                <label for="add-emp-no">구성원 번호:</label>
                <input type="text" id="add-emp-no" required><br>
                <label for="add-name">이름:</label>
                <input type="text" id="add-name" required><br>
                <label for="add-year">평가 연도:</label>
                <input type="text" id="add-year" required><br>
                <label for="add-achievement">성취도:</label>
                <input type="text" id="add-achievement" required><br>
                <label for="add-leadership">리더십:</label>
                <input type="text" id="add-leadership" required><br>
                <label for="add-teamwork">팀워크:</label>
                <input type="text" id="add-teamwork" required><br>
                <label for="add-problem-solving">문제 해결 능력:</label>
                <input type="text" id="add-problem-solving" required><br>
                <label for="add-communication">의사소통 능력:</label>
                <input type="text" id="add-communication" required><br>
                <button type="button" onclick="addEvaluation()">추가하기</button>
            </form>
        </div>
    </div>

    <script>
        let evaluations = [];  // 전역 변수로 evaluations 배열을 정의합니다.

        function displayEvaluations(filteredEvaluations) {
            const evaluationList = document.getElementById("evaluation-list");
            evaluationList.innerHTML = "";
            filteredEvaluations.forEach((evaluation, index) => {
                const evaluationItem = document.createElement("div");
                evaluationItem.className = "evaluation-item";
                evaluationItem.innerHTML = `
                    <div class="evaluation-header">
                        <h3>이름: ${evaluation.name}</h3>
                        <div class="menu">
                            <span onclick="toggleMenu(${index})">...</span>
                            <div class="dropdown-menu" id="menu-${index}">
                                <button onclick="editEvaluation(${index})">수정</button>
                                <button onclick="deleteEvaluation(${index})">삭제</button>
                            </div>
                        </div>
                    </div>
                    <p>고유 번호: ${evaluation.emp_no}</p>
                    <p>평가 연도: ${evaluation.year}</p>
                    <p>성취도: ${evaluation.achievement}</p>
                    <p>리더십: ${evaluation.leadership}</p>
                    <p>팀워크: ${evaluation.teamwork}</p>
                    <p>문제 해결 능력: ${evaluation.problem_solving}</p>
                    <p>의사소통 능력: ${evaluation.communication}</p>
                `;
                evaluationList.appendChild(evaluationItem);
            });
        }

        function searchEvaluation() {
            const searchTerm = document.getElementById("search").value.toLowerCase();
            const filteredEvaluations = evaluations.filter((evaluation) =>
                evaluation.name.toLowerCase().includes(searchTerm)
            );
            displayEvaluations(filteredEvaluations);
        }

        window.onload = () => {
            fetchEvaluations();
        };

        function fetchEvaluations() {
            $.ajax({
                url: "fetch_evaluations.php",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    evaluations = data;  // 데이터를 전역 변수에 할당합니다.
                    displayEvaluations(evaluations);
                },
                error: function (error) {
                    console.log("Error fetching data:", error);
                },
            });
        }

        // 메뉴 표시/숨김 토글 함수
        function toggleMenu(index) {
            const menu = document.getElementById(`menu-${index}`);
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        // 평가 정보 수정 폼 표시 함수
        function editEvaluation(index) {
            const evaluation = evaluations[index];
            document.getElementById("edit-index").value = index;
            document.getElementById("edit-emp-no").value = evaluation.emp_no;
            document.getElementById("edit-name").value = evaluation.name;
            document.getElementById("edit-year").value = evaluation.year;
            document.getElementById("edit-achievement").value = evaluation.achievement;
            document.getElementById("edit-leadership").value = evaluation.leadership;
            document.getElementById("edit-teamwork").value = evaluation.teamwork;
            document.getElementById("edit-problem-solving").value = evaluation.problem_solving;
            document.getElementById("edit-communication").value = evaluation.communication;
            document.getElementById("edit-form").style.display = "block";
        }

        function saveEvaluationInfo() {
    const index = document.getElementById("edit-index").value;
    const emp_no = document.getElementById("edit-emp-no").value;
    const name = document.getElementById("edit-name").value;
    const year = document.getElementById("edit-year").value;
    const achievement = document.getElementById("edit-achievement").value;
    const leadership = document.getElementById("edit-leadership").value;
    const teamwork = document.getElementById("edit-teamwork").value;
    const problem_solving = document.getElementById("edit-problem-solving").value;
    const communication = document.getElementById("edit-communication").value;

    $.ajax({
        url: "update_evaluation.php",
        type: "POST",
        data: {
            emp_no: emp_no,
            year: year,
            achievement: achievement,
            leadership: leadership,
            teamwork: teamwork,
            problem_solving: problem_solving,
            communication: communication
        },
        success: function(response) {
            alert(response);
            evaluations[index].emp_no = emp_no;
            evaluations[index].year = year;
            evaluations[index].achievement = achievement;
            evaluations[index].leadership = leadership;
            evaluations[index].teamwork = teamwork;
            evaluations[index].problem_solving = problem_solving;
            evaluations[index].communication = communication;
            document.getElementById("edit-form").style.display = "none";
            displayEvaluations(evaluations);
        },
        error: function(error) {
            console.log("Error updating evaluation:", error);
        }
    });
}


        // 정보 수정 폼 닫기 함수
        function closeEditForm() {
            document.getElementById("edit-form").style.display = "none";
        }

        // 새 평가 추가 폼 표시 함수
        function openAddEvaluationForm() {
            document.getElementById("add-form").style.display = "block";
        }

     function addEvaluation() {
    const emp_no = document.getElementById("add-emp-no").value;
    const name = document.getElementById("add-name").value;
    const year = document.getElementById("add-year").value;
    const achievement = document.getElementById("add-achievement").value;
    const leadership = document.getElementById("add-leadership").value;
    const teamwork = document.getElementById("add-teamwork").value;
    const problem_solving = document.getElementById("add-problem-solving").value;
    const communication = document.getElementById("add-communication").value;

    $.ajax({
      url: "evaluation_register.php",
      type: "POST",
      data: {
        emp_no: emp_no,
        year: year,
        achievement: achievement,
        leadership: leadership,
        teamwork: teamwork,
        problem_solving: problem_solving,
        communication: communication
      },
      success: function(response) {
        closeAddForm();
        fetchEvaluations();
      },
      error: function(error) {
        console.log("Error adding evaluation:", error);
      }
    });
  }

        // 새 평가 추가 폼 닫기 함수
        function closeAddForm() {
            document.getElementById("add-form").style.display = "none";
        }

        // 평가 삭제 함수
        function deleteEvaluation(index) {
            const evaluation = evaluations[index];
            if (confirm("정말로 이 평가를 삭제하시겠습니까?")) {
                $.ajax({
                    url: "delete_evaluation.php",
                    type: "POST",
                    data: { emp_no: evaluation.emp_no, year: evaluation.year },
                    success: function (response) {
                        alert(response);
                        evaluations.splice(index, 1); // 평가 데이터에서 삭제
                        displayEvaluations(evaluations); // 목록 업데이트
                    },
                    error: function (error) {
                        console.log("Error deleting data:", error);
                    },
                });
            }
        }
    </script>
</body>
</html>

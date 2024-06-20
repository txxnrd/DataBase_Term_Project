<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>부서 정보</title>
    <link rel="stylesheet" href="department_info_styles.css" />
  </head>
  <body>
    <div class="container">
      <h2>부서 정보</h2>
      <div class="search-container">
        <input type="text" id="search" placeholder="부서 이름 검색..." />
        <button onclick="searchDepartment()">검색</button>
      </div>
      <div class="list-container" id="department-list">
        <!-- 부서 목록이 여기에 표시됩니다 -->
      </div>

      <div class="button-container">
        <button type="button" onclick="openAddDepartmentForm()">
          새 부서 추가
        </button>
      </div>
    </div>

    <!-- 수정 모달 -->
    <div id="edit-form" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeEditForm()">&times;</span>
        <h2>부서 정보 수정하기</h2>
        <form id="edit-department-form">
          <input type="hidden" id="edit-index" />
          <label for="edit-dept-number">부서 번호:</label>
          <input type="text" id="edit-dept-number" required /><br />
          <label for="edit-dept-name">부서 이름:</label>
          <input type="text" id="edit-dept-name" required /><br />
          <label for="edit-dept-head">부서 대표 번호:</label>
          <input type="text" id="edit-dept-head" required /><br />
          <label for="edit-dept-established-date">부서 설립 날짜:</label>
          <input type="date" id="edit-dept-established-date" required /><br />
          <label for="edit-dept-location">위치 층수:</label>
          <input type="text" id="edit-dept-location" required /><br />
          <button type="button" onclick="saveDepartmentInfo()">저장하기</button>
        </form>
      </div>
    </div>

    <!-- 추가 모달 -->
    <div id="add-form" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeAddForm()">&times;</span>
        <h2>새 부서 추가하기</h2>
        <form id="add-department-form">
          <label for="add-dept-number">부서 번호:</label>
          <input type="text" id="add-dept-number" required /><br />
          <label for="add-dept-name">부서 이름:</label>
          <input type="text" id="add-dept-name" required /><br />
          <label for="add-dept-head">부서 대표 번호:</label>
          <input type="text" id="add-dept-head" required /><br />
          <label for="add-dept-established-date">부서 설립 날짜:</label>
          <input type="date" id="add-dept-established-date" required /><br />
          <label for="add-dept-location">위치 층수:</label>
          <input type="text" id="add-dept-location" required /><br />
          <button type="button" onclick="addDepartment()">추가하기</button>
        </form>
      </div>
    </div>

    <script>
      // 임시 부서 데이터
      const departments = [
        {
          dept_number: 1,
          dept_name: "개발부서",
          dept_head: "김철수",
          dept_established_date: "2010-05-15",
          dept_location: 5,
        },
        {
          dept_number: 2,
          dept_name: "인사부서",
          dept_head: "박영희",
          dept_established_date: "2011-06-20",
          dept_location: 3,
        },
      ];

      function displayDepartments(filteredDepartments) {
        const departmentList = document.getElementById("department-list");
        departmentList.innerHTML = "";
        filteredDepartments.forEach((department, index) => {
          const departmentItem = document.createElement("div");
          departmentItem.className = "department-item";
          departmentItem.innerHTML = `
                    <div class="department-header">
                        <h3>${department.dept_name}</h3>
                        <div class="menu">
                            <span onclick="toggleMenu(${index})">...</span>
                            <div class="dropdown-menu" id="menu-${index}">
                                <button onclick="editDepartment(${index})">수정</button>
                                <button onclick="deleteDepartment(${index})">삭제</button>
                            </div>
                        </div>
                    </div>
                    <p>부서 번호: ${department.dept_number}</p>
                    <p>부서 대표 번호: ${department.dept_head}</p>
                    <p>부서 설립 날짜: ${department.dept_established_date}</p>
                    <p>위치 층수: ${department.dept_location}</p>
                `;
          departmentList.appendChild(departmentItem);
        });
      }

      function searchDepartment() {
        const searchTerm = document
          .getElementById("search")
          .value.toLowerCase();
        const filteredDepartments = departments.filter((department) =>
          department.dept_name.toLowerCase().includes(searchTerm)
        );
        displayDepartments(filteredDepartments);
      }

      window.onload = () => {
        displayDepartments(departments);
      };

      // 메뉴 표시/숨김 토글 함수
      function toggleMenu(index) {
        const menu = document.getElementById(`menu-${index}`);
        menu.style.display = menu.style.display === "block" ? "none" : "block";
      }

      // 부서 정보 수정 폼 표시 함수
      function editDepartment(index) {
        const department = departments[index];
        document.getElementById("edit-index").value = index;
        document.getElementById("edit-dept-number").value =
          department.dept_number;
        document.getElementById("edit-dept-name").value = department.dept_name;
        document.getElementById("edit-dept-head").value = department.dept_head;
        document.getElementById("edit-dept-established-date").value =
          department.dept_established_date;
        document.getElementById("edit-dept-location").value =
          department.dept_location;
        document.getElementById("edit-form").style.display = "block";
      }

      // 부서 정보 저장 함수
      function saveDepartmentInfo() {
        const index = document.getElementById("edit-index").value;
        departments[index].dept_number =
          document.getElementById("edit-dept-number").value;
        departments[index].dept_name =
          document.getElementById("edit-dept-name").value;
        departments[index].dept_head =
          document.getElementById("edit-dept-head").value;
        departments[index].dept_established_date = document.getElementById(
          "edit-dept-established-date"
        ).value;
        departments[index].dept_location =
          document.getElementById("edit-dept-location").value;
        document.getElementById("edit-form").style.display = "none";
        displayDepartments(departments);
      }

      // 정보 수정 폼 닫기 함수
      function closeEditForm() {
        document.getElementById("edit-form").style.display = "none";
      }

      // 새 부서 추가 폼 표시 함수
      function openAddDepartmentForm() {
        document.getElementById("add-form").style.display = "block";
      }

      // 새 부서 추가 함수
      function addDepartment() {
        const dept_number = document.getElementById("add-dept-number").value;
        const dept_name = document.getElementById("add-dept-name").value;
        const dept_head = document.getElementById("add-dept-head").value;
        const dept_established_date = document.getElementById(
          "add-dept-established-date"
        ).value;
        const dept_location =
          document.getElementById("add-dept-location").value;
        const newDepartment = {
          dept_number: parseInt(dept_number),
          dept_name,
          dept_head,
          dept_established_date,
          dept_location: parseInt(dept_location),
        };
        departments.push(newDepartment);
        document.getElementById("add-form").style.display = "none";
        displayDepartments(departments);
      }

      // 새 부서 추가 폼 닫기 함수
      function closeAddForm() {
        document.getElementById("add-form").style.display = "none";
      }

      // 부서 삭제 함수
      function deleteDepartment(index) {
        if (confirm("정말로 이 부서를 삭제하시겠습니까?")) {
          departments.splice(index, 1); // 부서 데이터에서 삭제
          displayDepartments(departments); // 목록 업데이트
        }
      }
    </script>
  </body>
</html>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>부서 정보</title>
    <link rel="stylesheet" href="department_info_styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>부서 정보</h2>
        <div class="search-container">
            <input type="text" id="search" placeholder="부서 이름 검색...">
            <button onclick="searchDepartment()">검색</button>
        </div>
        <div class="list-container" id="department-list">
            <!-- 부서 목록이 여기에 표시됩니다 -->
        </div>

        <div class="button-container">
            <button type="button" onclick="openAddDepartmentForm()">새 부서 추가</button>
        </div>
    </div>

    <!-- 수정 모달 -->
    <div id="edit-form" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditForm()">&times;</span>
            <h2>부서 정보 수정하기</h2>
            <form id="edit-department-form">
                <input type="hidden" id="edit-index">
                <label for="edit-dept-number" >부서 번호:</label>
                <input type="text" id="edit-dept-number" required readonly><br>
                <label for="edit-dept-name">부서 이름:</label>
                <input type="text" id="edit-dept-name" required><br>
                <label for="edit-dept-head">부서 대표 번호:</label>
                <input type="text" id="edit-dept-head" required><br>
                <label for="edit-dept-established-date">부서 설립 날짜:</label>
                <input type="date" id="edit-dept-established-date" required><br>
                <label for="edit-dept-location">위치 층수:</label>
                <input type="text" id="edit-dept-location" required><br>
                <button type="button" onclick="saveDepartmentInfo()">저장하기</button>
            </form>
        </div>
    </div>
<!-- 부서 대표 정보 모달 -->
<div id="member-info-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeMemberInfoModal()">&times;</span>
        <h2>부서 대표 정보</h2>
        <div id="member-info-container">
            <!-- 부서 대표 정보가 여기에 표시됩니다 -->
        </div>
    </div>
</div>

    <!-- 추가 모달 -->
    <div id="add-form" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddForm()">&times;</span>
            <h2>새 부서 추가하기</h2>
            <form id="add-department-form">
                <label for="add-dept-number">부서 번호:</label>
                <input type="text" id="add-dept-number" required><br>
                <label for="add-dept-name">부서 이름:</label>
                <input type="text" id="add-dept-name" required><br>
                <label for="add-dept-head">부서 대표 번호:</label>
                <input type="text" id="add-dept-head" required><br>
                <label for="add-dept-established-date">부서 설립 날짜:</label>
                <input type="date" id="add-dept-established-date" required><br>
                <label for="add-dept-location">위치 층수:</label>
                <input type="text" id="add-dept-location" required><br>
                <button type="button" onclick="addDepartment()">추가하기</button>
            </form>
        </div>
    </div>

    <script>
        let departments = [];

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
            const searchTerm = document.getElementById("search").value.toLowerCase();
            const filteredDepartments = departments.filter((department) =>
                department.dept_name.toLowerCase().includes(searchTerm)
            );
            displayDepartments(filteredDepartments);
        }

        window.onload = () => {
            fetchDepartments();
        };

        function fetchDepartments() {
            $.ajax({
                url: "fetch_departments.php",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    departments = data;
                    displayDepartments(departments);
                },
                error: function (error) {
                    console.log("Error fetching data:", error);
                },
            });
        }

        function toggleMenu(index) {
            const menu = document.getElementById(`menu-${index}`);
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        function editDepartment(index) {
            const department = departments[index];
            document.getElementById("edit-index").value = index;
            document.getElementById("edit-dept-number").value = department.dept_number;
            document.getElementById("edit-dept-name").value = department.dept_name;
            document.getElementById("edit-dept-head").value = department.dept_head;
            document.getElementById("edit-dept-established-date").value = department.dept_established_date;
            document.getElementById("edit-dept-location").value = department.dept_location;
            document.getElementById("edit-form").style.display = "block";
        }

        function saveDepartmentInfo() {
            const index = document.getElementById("edit-index").value;
            const dept_number = document.getElementById("edit-dept-number").value;
            const dept_name = document.getElementById("edit-dept-name").value;
            const dept_head = document.getElementById("edit-dept-head").value;
            const dept_established_date = document.getElementById("edit-dept-established-date").value;
            const dept_location = document.getElementById("edit-dept-location").value;

            $.ajax({
                url: "update_department.php",
                type: "POST",
                data: {
                    dept_number: dept_number,
                    dept_name: dept_name,
                    dept_head: dept_head,
                    dept_established_date: dept_established_date,
                    dept_location: dept_location
                },
                success: function(response) {
                    alert(response);
                    departments[index].dept_name = dept_name;
                    departments[index].dept_head = dept_head;
                    departments[index].dept_established_date = dept_established_date;
                    departments[index].dept_location = dept_location;
                    document.getElementById("edit-form").style.display = "none";
                    displayDepartments(departments);
                },
                error: function(error) {
                    console.log("Error updating department:", error);
                }
            });
        }

        function closeEditForm() {
            document.getElementById("edit-form").style.display = "none";
        }

        function openAddDepartmentForm() {
            document.getElementById("add-form").style.display = "block";
        }

        function addDepartment() {
            const dept_number = document.getElementById("add-dept-number").value;
            const dept_name = document.getElementById("add-dept-name").value;
            const dept_head = document.getElementById("add-dept-head").value;
            const dept_established_date = document.getElementById("add-dept-established-date").value;
            const dept_location = document.getElementById("add-dept-location").value;

            $.ajax({
                url: "department_info_register.php",
                type: "POST",
                data: {
                    dept_number: dept_number,
                    dept_name: dept_name,
                    dept_head: dept_head,
                    dept_established_date: dept_established_date,
                    dept_location: dept_location
                },
                success: function(response) {
                    alert(response);
                    fetchDepartments(); // 목록을 다시 불러와서 업데이트
                    closeAddForm();
                },
                error: function(error) {
                    console.log("Error adding department:", error);
                }
            });
        }
function fetchMemberById(empId) {
    $.ajax({
        url: "fetch_member_by_id.php", // 부서 대표 정보를 가져오는 PHP 파일
        type: "GET",
        data: { emp_id: empId },
        dataType: "json",
        success: function (data) {
            displayMemberInfo(data);
        },
        error: function (error) {
            console.log("Error fetching member by ID:", error);
        },
    });
}

function displayMemberInfo(member) {
    const memberInfoContainer = document.getElementById("member-info-container");
    memberInfoContainer.innerHTML = `
        <div class="member-item">
            <div class="member-header">
                <h3>${member.name}</h3>
            </div>
            <p>고유번호: ${member.emp_no}</p>
            <p>생년월일: ${member.date_of_birth}</p>
            <p>합류날짜: ${member.date_of_joining}</p>
            <p>휴대폰 번호:</p>
            <ul>
                ${member.phones.map(phone => `<li>${phone}</li>`).join("")}
            </ul>
        </div>
    `;
    document.getElementById("member-info-modal").style.display = "block";
}



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
            <p>부서 대표 번호: <a href="#" onclick="fetchMemberById(${department.dept_head})">${department.dept_head}</a></p>
            <p>부서 설립 날짜: ${department.dept_established_date}</p>
            <p>위치 층수: ${department.dept_location}</p>
        `;
        departmentList.appendChild(departmentItem);
    });
}


function closeMemberInfoModal() {
    document.getElementById("member-info-modal").style.display = "none";
}

        function closeAddForm() {
            document.getElementById("add-form").style.display = "none";
        }

        function deleteDepartment(index) {
            const department = departments[index];
            if (confirm("정말로 이 부서를 삭제하시겠습니까?")) {
                $.ajax({
                    url: "delete_department.php",
                    type: "POST",
                    data: { dept_number: department.dept_number },
                    success: function (response) {
                        alert(response);
                        departments.splice(index, 1);
                        displayDepartments(departments);
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

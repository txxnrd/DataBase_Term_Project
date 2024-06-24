<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>구성원 정보</title>
    <link rel="stylesheet" href="member_info_styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>구성원 정보</h2>
        <div class="search-container">
            <input type="text" id="search" placeholder="구성원 검색...">
            <button onclick="searchMember()">검색</button>
        </div>
        <div class="list-container" id="member-list">
            <!-- 구성원 목록이 여기에 표시됩니다 -->
        </div>

        <div class="button-container">
            <button type="button" onclick="openAddMemberForm()">새 구성원 추가</button>
        </div>
       
        
    </div>

    <!-- 수정 모달 -->
    <div id="edit-form" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditForm()">&times;</span>
            <h2>정보 수정하기</h2>
            <form id="edit-member-form">
                <input type="hidden" id="edit-index">
                <label for="edit-name">이름:</label>
                <input type="text" id="edit-name" required><br>
                <label for="edit-birthdate">생년월일:</label>
                <input type="date" id="edit-birthdate" required><br>
                <label for="edit-join-date">합류 날짜:</label>
                <input type="date" id="edit-join-date" required><br>
                <label for="edit-phones">휴대폰 번호:</label>
                <div id="edit-phones-container">
                    <input type="text" class="edit-phone" required><br>
                </div>
                <button type="button" onclick="addEditPhone()">번호 추가</button>
                <button type="button" onclick="saveMemberInfo()">저장하기</button>
            </form>
        </div>
    </div>

    <!-- 추가 모달 -->
    <div id="add-form" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddForm()">&times;</span>
            <h2>새 구성원 추가하기</h2>
            <form id="add-member-form" action="member_info_register.php" method="POST">
                <label for="add-name">이름:</label>
                <input type="text" id="add-name" name="name" required><br>
                <label for="add-birthdate">생년월일:</label>
                <input type="date" id="add-birthdate" name="date_of_birth" required><br>
                <label for="add-join-date">합류 날짜:</label>
                <input type="date" id="add-join-date" name="date_of_joining" required><br>
                <label for="add-phones">휴대폰 번호:</label>
                <div id="add-phones-container">
                    <input type="text" class="add-phone" name="phones[]" required><br>
                </div>
                <button type="button" onclick="addAddPhone()">번호 추가</button>
                <button type="submit">추가하기</button>
            </form>
        </div>
        
    </div>

    <script>
    let members = [];

function displayMembers(filteredMembers) {
    const memberList = document.getElementById("member-list");
    memberList.innerHTML = "";
    filteredMembers.forEach((member, index) => {
        const memberItem = document.createElement("div");
        memberItem.className = "member-item";
        memberItem.innerHTML = `
            <div class="member-header">
                <h3>${member.name}</h3>
                <div class="menu">
                    <span onclick="toggleMenu(${index})">...</span>
                    <div class="dropdown-menu" id="menu-${index}">
                        <button onclick="editMember(${index})">수정</button>
                        <button onclick="deleteMember(${index})">삭제</button>
                    </div>
                </div>
            </div>
            <p>고유번호: ${member.emp_no}</p>
            <p>생년월일: ${member.date_of_birth}</p>
            <p>합류날짜: ${member.date_of_joining}</p>
            <p>휴대폰 번호: ${member.phones.length}개 
                <button onclick="showPhones(${index})">자세히 보기</button>
            </p>
            <ul id="phones-list-${index}" style="display: none;">
                ${member.phones.map(phone => `<li>${phone}</li>`).join("")}
            </ul>
        `;
        memberList.appendChild(memberItem);
    });
}

function showPhones(index) {
    const phonesList = document.getElementById(`phones-list-${index}`);
    phonesList.style.display = phonesList.style.display === "none" ? "block" : "none";
}

function fetchMembers() {
    $.ajax({
        url: "fetch_members.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
            members = data;  // 데이터를 전역 변수에 할당합니다.
            displayMembers(members);
        },
        error: function (error) {
            console.log("Error fetching data:", error);
        },
    });
}
 function searchMember() {
            const searchTerm = document.getElementById("search").value.toLowerCase();
            const filteredMembers = members.filter((member) =>
                member.name.toLowerCase().includes(searchTerm)
            );
            displayMembers(filteredMembers);
        }

window.onload = () => {
    fetchMembers();
};


        function fetchMembers() {
    $.ajax({
        url: "fetch_members.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
            members = data;  // 데이터를 전역 변수에 할당합니다.
            displayMembers(members);
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

        // 구성원 정보 수정 폼 표시 함수
        function editMember(index) {
            const member = members[index];
            document.getElementById("edit-index").value = index;
            document.getElementById("edit-name").value = member.name;
            document.getElementById("edit-birthdate").value = member.date_of_birth;
            document.getElementById("edit-join-date").value = member.date_of_joining;

            const phonesContainer = document.getElementById("edit-phones-container");
            phonesContainer.innerHTML = "";
            member.phones.forEach(phone => {
                const input = document.createElement("input");
                input.type = "text";
                input.value = phone;
                input.className = "edit-phone";
                input.required = true;
                phonesContainer.appendChild(input);
                phonesContainer.appendChild(document.createElement("br"));
            });
            document.getElementById("edit-form").style.display = "block";
        }

        function addEditPhone() {
            const phonesContainer = document.getElementById("edit-phones-container");
            const input = document.createElement("input");
            input.type = "text";
            input.className = "edit-phone";
            input.required = true;
            phonesContainer.appendChild(input);
            phonesContainer.appendChild(document.createElement("br"));
        }

      function saveMemberInfo() {
    const index = document.getElementById("edit-index").value;
    const name = document.getElementById("edit-name").value;
    const date_of_birth = document.getElementById("edit-birthdate").value;
    const date_of_joining = document.getElementById("edit-join-date").value;

    const phoneInputs = document.querySelectorAll(".edit-phone");
    const phones = Array.from(phoneInputs).map(input => input.value);

    $.ajax({
        url: "update_member.php",
        type: "POST",
        data: {
            emp_no: members[index].emp_no,
            name: name,
            
            date_of_birth: date_of_birth,
            date_of_joining: date_of_joining,
            phones: phones
        },
        success: function(response) {
            alert(response);
            members[index].name = name;
            
            members[index].date_of_birth = date_of_birth;
            members[index].date_of_joining = date_of_joining;
            members[index].phones = phones;
            document.getElementById("edit-form").style.display = "none";
            displayMembers(members);
        },
        error: function(error) {
            console.log("Error updating member:", error);
        }
    });
}

        // 정보 수정 폼 닫기 함수
        function closeEditForm() {
            document.getElementById("edit-form").style.display = "none";
        }

// 새 구성원 추가 폼 표시 함수
      function openAddMemberForm() {
        document.getElementById("add-form").style.display = "block";
      }
      
        function addAddPhone() {
            const phonesContainer = document.getElementById("add-phones-container");
            const input = document.createElement("input");
            input.type = "text";
            input.className = "add-phone";
            input.name = "phones[]";
            input.required = true;
            phonesContainer.appendChild(input);
            phonesContainer.appendChild(document.createElement("br"));
        }
        // 새 구성원 추가 함수
      function addMember() {
        const name = document.getElementById("add-name").value;
        const dept = document.getElementById("add-dept").value;
        const birthdate = document.getElementById("add-birthdate").value;
        const joinDate = document.getElementById("add-join-date").value;
        const phoneInputs = document.querySelectorAll(".add-phone");
        const phones = Array.from(phoneInputs).map((input) => input.value);

        const newMember = {
          emp_no: members.length + 1, // 임시 emp_no 생성
          name,
          dept_name: dept,
          date_of_birth: birthdate,
          join_date: joinDate,
          phones,
        };
        members.push(newMember);
        document.getElementById("add-form").style.display = "none";
        displayMembers(members);
      }

        // 새 구성원 추가 폼 닫기 함수
        function closeAddForm() {
            document.getElementById("add-form").style.display = "none";
        }

       function deleteMember(index) {
    if (confirm("정말로 이 구성원을 삭제하시겠습니까?")) {
        const member = members[index];
        
        $.ajax({
            url: "delete_member.php",
            type: "POST",
            data: { emp_no: member.emp_no },
            success: function(response) {
                console.log(response);
                // 배열에서 구성원 삭제
                members.splice(index, 1);
                // 목록 업데이트
                displayMembers(members);
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
    }
}

    </script>
</body>
</html>

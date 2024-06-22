# 고려대학교 데이터베이스 371 텀프로젝트

이 프로젝트는 고려대학교 데이터베이스 371 과목의 텀프로젝트로, 웹 애플리케이션을 통해 구성원 정보를 관리하고, 구성원의 연도별 인사 평가 정보를 저장하는 시스템입니다. 이 프로젝트는 HTML, CSS, JavaScript, PHP, 그리고 MariaDB를 사용하여 구현되었습니다.

## 프로젝트 구조

### HTML 파일

- **index.php**: 구성원 목록을 보여주고, 구성원을 추가, 수정, 삭제할 수 있는 메인 페이지입니다.
- **register.php**: 새 구성원을 등록하는 PHP 스크립트입니다.
- **fetch_members.php**: 구성원 정보를 가져오는 PHP 스크립트입니다.
- **edit_member.php**: 구성원 정보를 수정하는 PHP 스크립트입니다.
- **delete_member.php**: 구성원 정보를 삭제하는 PHP 스크립트입니다.
- **evaluation.html**: 구성원의 연도별 인사 평가 정보를 보여주는 페이지입니다.

### 데이터베이스 테이블

- **employee**: 구성원 정보를 저장하는 테이블입니다.
- **Phone**: 구성원의 휴대폰 번호를 저장하는 테이블입니다.
- **Evaluation**: 구성원의 연도별 인사 평가 정보를 저장하는 테이블입니다.

## 설치 및 실행 방법

1. MariaDB를 설치하고, 다음 명령어를 통해 데이터베이스와 테이블을 생성합니다.

   ```sql
   CREATE DATABASE db2022320094;

   USE db2022320094;

   CREATE TABLE employee (
       emp_no INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255) NOT NULL,
       date_of_birth DATE NOT NULL,
       date_of_joining DATE NOT NULL
   );

   CREATE TABLE Phone (
       id INT AUTO_INCREMENT PRIMARY KEY,
       emp_no INT,
       phone_number VARCHAR(255),
       FOREIGN KEY (emp_no) REFERENCES employee(emp_no) ON DELETE CASCADE
   );

   CREATE TABLE Evaluation (
       emp_no INT NOT NULL,
       year INT NOT NULL,
       Achievement INT,
       Leadership INT,
       teamwork INT,
       problem_solving INT,
       communication INT,
       PRIMARY KEY (emp_no, year),
       FOREIGN KEY (emp_no) REFERENCES employee(emp_no)
   );
   ```

2. 웹 서버 (Apache, Nginx 등)를 설정하고, PHP를 설치합니다.

3. 프로젝트 파일을 웹 서버의 루트 디렉토리에 복사합니다.

4. `fetch_members.php`, `register.php`, `edit_member.php`, `delete_member.php` 파일에 데이터베이스 연결 설정을 수정합니다.

   ```php
   // 데이터베이스 연결 설정 예시
   $host = "localhost";
   $db_id = "db2022320094"; // 데이터베이스 사용자 아이디
   $db_password = "your_password"; // 데이터베이스 사용자 비밀번호
   $db_name = "db2022320094"; // 데이터베이스 이름
   ```

5. 웹 브라우저에서 `index.php` 파일을 엽니다.

## 주요 기능

- 구성원 정보 조회, 추가, 수정, 삭제
- 구성원의 휴대폰 번호 관리
- 구성원의 연도별 인사 평가 정보 조회, 추가, 수정, 삭제

## 참고

이 프로젝트는 고려대학교 데이터베이스 371 과목의 텀프로젝트로 수행되었습니다.

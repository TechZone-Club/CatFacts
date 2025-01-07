# Ứng dụng Laravel: Tạo file PDF với các sự thật thú vị về mèo

---

## **Tổng quan dự án**

Dự án này yêu cầu tạo một ứng dụng Laravel để xuất file PDF chứa các sự thật thú vị về mèo. Mục tiêu là thể hiện kỹ năng phát triển backend bằng Laravel với API Get cơ bản và quản lý quy trình làm việc cộng tác.

---

## **Yêu cầu dự án**

- Mỗi thành viên cần:
  - Tạo **nhánh riêng** để phát triển.
  - Commit các thay đổi lên nhánh của mình một cách thường xuyên.
  - Gửi **Pull Request (PR)** để merge nhánh của mình vào nhánh chính (main/master) để review.
- Commit cuối cùng của mỗi thành viên phải chứa từ khóa **"Finished"** trong thông điệp commit.

---

## **Frontend**
- Giao diện chỉ cần sử dụng một file Blade đơn giản.
- Chức năng:
  - Một **trường nhập số** để người dùng nhập số lượng sự thật về mèo muốn nhận.
  - Một nút **"Lấy thông tin"** để gửi yêu cầu tới backend.

---

## **Backend**
- Sử dụng Laravel tiêu chuẩn để triển khai backend.
- Tích hợp API [https://catfact.ninja/docs](https://catfact.ninja/docs) để lấy các sự thật về mèo (không yêu cầu xác thực).
- Tạo file PDF bằng cách sử dụng: Thư viện PHP (ví dụ: Dompdf, TCPDF, v.v.), hoặc

---

## **Mục tiêu nâng cao**

### 1. **Lưu trữ và quản lý file PDF**
- Lưu các file PDF đã tạo vào backend.

### 2. **Hiển thị danh sách file PDF**
- Tạo trang hiển thị danh sách các file PDF đã lưu.
- Sắp xếp danh sách theo **thứ tự giảm dần** dựa trên số lượng sự thật.
- Cho phép người dùng tải xuống file PDF trực tiếp từ danh sách.


---

## **Quy trình làm việc nhóm**
1. Mỗi thành viên làm việc trên nhánh riêng của mình.
2. Commit thay đổi thường xuyên với các thông điệp ý nghĩa.
3. Đảm bảo commit cuối cùng chứa từ khóa **"Finished"**.

---

## **Ghi chú bổ sung**
- Để tạo file PDF, bạn có thể lựa chọn: [Dompdf](https://github.com/dompdf/dompdf)
- Tuân thủ các thực hành tốt nhất trong viết mã và tài liệu.

## Thang Điểm Chấm Dự Án (Tổng: 10 điểm)

### 1. Hoàn Thành Chức Năng Frontend (2 điểm)
- **1 điểm**: Hiển thị giao diện đơn giản với Blade.
- **1 điểm**: Gửi yêu cầu từ frontend đến backend.

### 2. Hoàn Thành Chức Năng Backend Cơ Bản (3 điểm)
- **1.5 điểm**: Tích hợp API CatFact Ninja để lấy dữ liệu.
- **1.5 điểm**: Tạo file PDF chứa các sự thật thú vị.

### 3. Mục Tiêu Nâng Cao (3 điểm)
- **1 điểm**: Lưu trữ file PDF vào backend.
- **1 điểm**: Hiển thị danh sách file PDF đã lưu.
- **1 điểm**: Cho phép tải xuống file từ danh sách.

### 4. Quy Trình Làm Việc Nhóm và Git (2 điểm)
- **1 điểm**: Sử dụng nhánh riêng, commit thường xuyên.
- **1 điểm**: Gửi PR đúng quy trình, commit cuối có từ khóa "Finished".

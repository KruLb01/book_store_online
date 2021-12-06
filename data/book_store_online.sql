-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 04:44 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_hoa_don`
--

CREATE TABLE `chi_tiet_hoa_don` (
  `id_hoa_don` varchar(10) NOT NULL,
  `id_san_pham` varchar(10) NOT NULL,
  `so_luong` int(10) NOT NULL,
  `don_gia` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_phieu_nhap`
--

CREATE TABLE `chi_tiet_phieu_nhap` (
  `id_phieu_nhap` varchar(10) NOT NULL,
  `id_sach` varchar(10) NOT NULL,
  `so_luong` int(10) NOT NULL,
  `don_gia` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_quyen_chuc_nang`
--

CREATE TABLE `chi_tiet_quyen_chuc_nang` (
  `id_quyen` varchar(10) NOT NULL,
  `id_chuc_nang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chuc_nang`
--

CREATE TABLE `chuc_nang` (
  `id_chuc_nang` varchar(10) NOT NULL,
  `ten_chuc_nang` varchar(50) NOT NULL,
  `mo_ta` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `danh_gia`
--

CREATE TABLE `danh_gia` (
  `id_danh_gia` varchar(10) NOT NULL,
  `id_san_pham` varchar(10) NOT NULL,
  `id_hoa_don` varchar(10) NOT NULL,
  `id_nguoi_dung` varchar(20) NOT NULL,
  `so_sao_danh_gia` int(1) NOT NULL,
  `binh_luan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `danh_muc`
--

CREATE TABLE `danh_muc` (
  `id_danh_muc` varchar(10) NOT NULL,
  `ten_danh_muc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `danh_muc`
--

INSERT INTO `danh_muc` (`id_danh_muc`, `ten_danh_muc`) VALUES
('DM001', 'Văn học'),
('DM002', 'Kinh tế'),
('DM003', 'Tâm lý'),
('DM004', 'Thiếu nhi'),
('DM005', 'Tiểu sử');

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id_nguoi_dung` varchar(20) NOT NULL,
  `id_san_pham` varchar(10) NOT NULL,
  `so_luong` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hinh_thuc_giao_hang`
--

CREATE TABLE `hinh_thuc_giao_hang` (
  `id_hinh_thuc` varchar(10) NOT NULL,
  `ten_hinh_thuc` varchar(50) NOT NULL,
  `mo_ta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don`
--

CREATE TABLE `hoa_don` (
  `id_hoa_don` varchar(10) NOT NULL,
  `id_nguoi_dung` varchar(10) NOT NULL,
  `ngay_mua` date NOT NULL,
  `tong_gia` int(20) NOT NULL,
  `hinh_thuc_giao_hang` varchar(10) NOT NULL,
  `tinh_trang_don_hang` int(1) NOT NULL,
  `id_sale` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `tai_khoan` varchar(20) NOT NULL,
  `mat_khau` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ho_ten` varchar(50) NOT NULL,
  `dia_chi` varchar(50) NOT NULL,
  `so_dien_thoai` int(10) NOT NULL,
  `tinh_trang_tai_khoan` tinyint(1) NOT NULL,
  `id_quyen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nha_xuat_ban`
--

CREATE TABLE `nha_xuat_ban` (
  `id_nha_xuat_ban` varchar(10) NOT NULL,
  `ten_nha_xuat_ban` varchar(50) NOT NULL,
  `mo_ta_nha_xuat_ban` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nha_xuat_ban`
--

INSERT INTO `nha_xuat_ban` (`id_nha_xuat_ban`, `ten_nha_xuat_ban`, `mo_ta_nha_xuat_ban`) VALUES
('NXB001', 'NXB Hội Nhà Văn', ''),
('NXB002', 'NXB Trẻ', ''),
('NXB003', 'Nhà Xuất Bản Hồng Đức', ''),
('NXB004', 'NXB Thế Giới', ''),
('NXB005', 'NXB Tổng Hợp TPHCM', ''),
('NXB006', 'NXB Lao Động', ''),
('NXB007', 'NXB Thanh Hóa', ''),
('NXB008', 'NXB Thanh Niên', ''),
('NXB009', 'NXB Hà Nội', ''),
('NXB010', 'NXB Thanh Niên', ''),
('NXB011', 'NXB Kim Đồng', ''),
('NXB012', 'NXB Kinh tế TP.Hồ Chí Minh', ''),
('NXB013', 'NXB Phụ Nữ Việt Nam', '');

-- --------------------------------------------------------

--
-- Table structure for table `phieu_nhap`
--

CREATE TABLE `phieu_nhap` (
  `id_phieu_nhap` varchar(10) NOT NULL,
  `id_nhan_vien_nhap` varchar(20) NOT NULL,
  `id_nha_xuat_ban` varchar(10) NOT NULL,
  `ngay_nhap` date NOT NULL,
  `tong_gia_nhap` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quyen`
--

CREATE TABLE `quyen` (
  `id_quyen` varchar(10) NOT NULL,
  `ten_quyen` varchar(50) NOT NULL,
  `mo_ta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id_sale` varchar(10) NOT NULL,
  `ten_sale` varchar(50) NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `giam_theo_%` int(10) NOT NULL,
  `giam_theo_vnd` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `id_san_pham` varchar(10) NOT NULL,
  `id_danh_muc` varchar(10) NOT NULL,
  `ten_san_pham` varchar(100) NOT NULL,
  `id_tac_gia` varchar(10) NOT NULL,
  `id_nha_xuat_ban` varchar(10) NOT NULL,
  `nam_xuat_ban` year(4) NOT NULL,
  `so_luong` int(10) NOT NULL,
  `mo_ta_sach` text NOT NULL,
  `ngon_ngu` varchar(20) NOT NULL,
  `gia_sach_giay` int(20) NOT NULL,
  `gia_sach_ebook` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`id_san_pham`, `id_danh_muc`, `ten_san_pham`, `id_tac_gia`, `id_nha_xuat_ban`, `nam_xuat_ban`, `so_luong`, `mo_ta_sach`, `ngon_ngu`, `gia_sach_giay`, `gia_sach_ebook`) VALUES
('SP001', 'DM001', 'Nhà Giả Kim (Tái Bản 2020)\r\n', 'TG001', 'NXB001', 2020, 20, '<i>Tất cả những trải nghiệm trong chuyến phiêu du theo đuổi vận mệnh của mình đã giúp Santiago thấu hiểu được ý nghĩa sâu xa nhất của hạnh phúc, hòa hợp với vũ trụ và con người.</i> \r\n\r\nTiểu thuyết Nhà giả kim của Paulo Coelho như một câu chuyện cổ tích giản dị, nhân ái, giàu chất thơ, thấm đẫm những minh triết huyền bí của phương Đông. Trong lần xuất bản đầu tiên tại Brazil vào năm 1988, sách chỉ bán được 900 bản. Nhưng, với số phận đặc biệt của cuốn sách dành cho toàn nhân loại, vượt ra ngoài biên giới quốc gia, Nhà giả kim đã làm rung động hàng triệu tâm hồn, trở thành một trong những cuốn sách bán chạy nhất mọi thời đại, và có thể làm thay đổi cuộc đời người đọc.\r\n\r\n“Nhưng nhà luyện kim đan không quan tâm mấy đến những điều ấy. Ông đã từng thấy nhiều người đến rồi đi, trong khi ốc đảo và sa mạc vẫn là ốc đảo và sa mạc. Ông đã thấy vua chúa và kẻ ăn xin đi qua biển cát này, cái biển cát thường xuyên thay hình đổi dạng vì gió thổi nhưng vẫn mãi mãi là biển cát mà ông đã biết từ thuở nhỏ. Tuy vậy, tự đáy lòng mình, ông không thể không cảm thấy vui trước hạnh phúc của mỗi người lữ khách, sau bao ngày chỉ có cát vàng với trời xanh nay được thấy chà là xanh tươi hiện ra trước mắt. ‘Có thể Thượng đế tạo ra sa mạc chỉ để cho con người biết quý trọng cây chà là,’ ông nghĩ.”\r\n\r\n- Trích <i>Nhà giả kim</i>\r\n\r\n<b>Nhận định</b>\r\n\r\n“Sau Garcia Márquez, đây là nhà văn Mỹ Latinh được đọc nhiều nhất thế giới.” - <i>The Economist, London, Anh</i>\r\n\r\n \r\n\r\n“Santiago có khả năng cảm nhận bằng trái tim như Hoàng tử bé của Saint-Exupéry.” - <i>Frankfurter Allgemeine Zeitung, Đức</i>', 'Tiếng Việt', 79000, 70000),
('SP002', 'DM001', 'Cây Cam Ngọt Của Tôi\r\n', 'TG002', 'NXB001', 2020, 20, '“Vị chua chát của cái nghèo hòa trộn với vị ngọt ngào khi khám phá ra những điều khiến cuộc đời này đáng sống... một tác phẩm kinh điển của Brazil.” - <b>Booklist</b>\r\n\r\n“Một cách nhìn cuộc sống gần như hoàn chỉnh từ con mắt trẻ thơ… có sức mạnh sưởi ấm và làm tan nát cõi lòng, dù người đọc ở lứa tuổi nào.” - <b>The National</b>\r\n\r\nHãy làm quen với Zezé, cậu bé tinh nghịch siêu hạng đồng thời cũng đáng yêu bậc nhất, với ước mơ lớn lên trở thành nhà thơ cổ thắt nơ bướm. Chẳng phải ai cũng công nhận khoản “đáng yêu” kia đâu nhé. Bởi vì, ở cái xóm ngoại ô nghèo ấy, nỗi khắc khổ bủa vây đã che mờ mắt người ta trước trái tim thiện lương cùng trí tưởng tượng tuyệt vời của cậu bé con năm tuổi.\r\n\r\nCó hề gì đâu bao nhiêu là hắt hủi, đánh mắng, vì Zezé đã có một người bạn đặc biệt để trút nỗi lòng: cây cam ngọt nơi vườn sau. Và cả một người bạn nữa, bằng xương bằng thịt, một ngày kia xuất hiện, cho cậu bé nhạy cảm khôn sớm biết thế nào là trìu mến, thế nào là nỗi đau, và mãi mãi thay đổi cuộc đời cậu.\r\n\r\nMở đầu bằng những thanh âm trong sáng và kết thúc lắng lại trong những nốt trầm hoài niệm, Cây cam ngọt của tôi khiến ta nhận ra vẻ đẹp thực sự của cuộc sống đến từ những điều giản dị như bông hoa trắng của cái cây sau nhà, và rằng cuộc đời thật khốn khổ nếu thiếu đi lòng yêu thương và niềm trắc ẩn. Cuốn sách kinh điển này bởi thế không ngừng khiến trái tim người đọc khắp thế giới thổn thức, kể từ khi ra mắt lần đầu năm 1968 tại Brazil.\r\n\r\n<b>TÁC GIẢ:</b>\r\n\r\nJOSÉ MAURO DE VASCONCELOS (1920-1984) là nhà văn người Brazil. Sinh ra trong một gia đình nghèo ở ngoại ô Rio de Janeiro, lớn lên ông phải làm đủ nghề để kiếm sống. Nhưng với tài kể chuyện thiên bẩm, trí nhớ phi thường, trí tưởng tượng tuyệt vời cùng vốn sống phong phú, José cảm thấy trong mình thôi thúc phải trở thành nhà văn nên đã bắt đầu sáng tác năm 22 tuổi. Tác phẩm nổi tiếng nhất của ông là tiểu thuyết mang màu sắc tự truyện Cây cam ngọt của tôi. Cuốn sách được đưa vào chương trình tiểu học của Brazil, được bán bản quyền cho hai mươi quốc gia và chuyển thể thành phim điện ảnh. Ngoài ra, José còn rất thành công trong vai trò diễn viên điện ảnh và biên kịch.', 'Tiếng Việt', 108000, 100000),
('SP003', 'DM001', 'Truyền Thuyết Thành Troy Và Hy Lạp', 'TG003', 'NXB001', 2017, 20, '\"Trong tác phẩm này, tác giả Andrew Lang đã vận dụng những kiến thức thông thái của mình về lịch sử và văn học để viết lại câu chuyện về trận chiến huyền thoại giữa người Hy Lạp và thành Troy trong sử thi của Homer. Thêm vào đó, cuốn sách cũng đề cập đến những cuộc phiêu lưu của các anh hùng Theseus và Perseus, đồng thời kể về hành trình của Jason đi tìm bộ lông cừu vàng. Cuốn sách này chắc chắn sẽ làm thỏa mãn những bạn đọc yêu thích tìm hiểu những truyền thuyết kỳ thú và các tập tục văn hóa của người Hy Lạp khi xưa.\"', 'Tiếng Việt', 109000, 100000),
('SP004', 'DM001', 'Bộ Tột Cùng Hạnh Phúc', 'TG004', 'NXB001', 2018, 20, '<b>BỘ TỘT CÙNG HẠNH PHÚC</b> là thiên sử thi về xã hội Ấn Độ phi lý tân thời: hỗn loạn, mâu thuẫn, bạo lực, bất công, điên rồ và vô lý, nó vừa là một chuyện tình bi thương vừa là lời phản kháng quyết liệt. Giọng văn của <b>Arundhati Roy</b> khi tỉ tê, khi lớn tiếng, khi nghẹn ngào, và có khi với cả tiếng cười, cùng với thủ pháp khéo léo Roy đã dệt nên những câu chuyện đan xen về đẳng cấp và tôn giáo, về bản sắc giới tính và xung đột chính trị - Nhân vật chính là những thân phận bị hủy hoại, thế giới quan tan vỡ, những con người bên lề xã hội đang cố tìm cho một chỗ đứng. Cuốn tiểu thuyết tuy viết về hiện thực bất ổn, nhưng lại đem cho người ta những hy vọng về tình yêu, và những ngày đen tối nhất rồi cũng sẽ qua đi, ngày mai bao giờ cũng tới, tình yêu sẽ đến với những ai vẫn hy vọng dù đã từng thất vọng, vẫn tin tưởng dù từng bị phản bội, vẫn yêu thương dù từng bị tổn thương.Mời các bạn cùng đến với <b>\"Bộ Tột Cùng Hạnh Phúc\"</b>', 'Tiếng Việt', 168000, 160000),
('SP005', 'DM002', 'D. Trump - Nghệ Thuật Đàm Phán (Tái Bản 2020)', 'TG005', 'NXB002', 2020, 20, 'Quyển sách cho chúng ta thấy cách Trump làm việc mỗi ngày - cách ông điều hành công việc kinh doanh và cuộc sống - cũng như cách ông trò chuyện với bạn bè và gia đình, làm ăn với đối thủ, mua thành công những sòng bạc hàng đầu ở thành phố Atlantic, thay đổi bộ mặt của những cao ốc ở thành phố New York… và xây dựng những tòa nhà chọc trời trên thế giới.\r\n\r\nQuyển sách đi sâu vào đầu óc của một doanh nhân xuất sắc và khám phá một cách khoa học chưa từng thấy về cách đàm phán một thương vụ thành công. Đây là một cuốn sách thú vị về đàm phán và kinh doanh – và là một cuốn sách nên đọc cho bất kỳ ai quan tâm đến đầu tư, bất động sản và thành công.', 'Tiếng Việt', 109000, 100000),
('SP006', 'DM002', 'Thủ Lĩnh Bộ Lạc', 'TG006', 'NXB003', 2020, 20, 'Trong bất kì nhóm người nào cũng sẽ có một bộ lạc khoảng từ 20 đến 150 người, có sự quen biết nhau đủ rõ. Và nếu họ gặp nhau trên đường, họ sẽ dừng lại và nói “Xin chào”. Họ là những người có thể có tên trong điện thoại và danh bạ email của bạn.\r\n\r\nThủ Lĩnh Bộ Lạc là mối quan hệ tương hỗ giữa các nhà lãnh đạo và thành viên của bộ lạc. Các Thủ lĩnh Bộ lạc nỗ lực tập trung vào việc xây dựng – hay nói chính xác hơn là nâng cao văn hoá của bộ lạc. Nếu họ thành công, bộ lạc sẽ công nhận họ là thủ lĩnh, cống hiến hết mình, trung thành và như vậy họ sẽ liên tục có được những thành công.\r\n\r\n<b>5 giai đoạn phát triển của bộ lạc – thuật lãnh đạo xuất chúng để đưa tổ chức vươn tới một tầm cao mới</b>\r\nTừ một nghiên cứu thực địa 10 năm với 24.000 người trong 24 tổ chức trên toàn thế giới, các tác giả nhận thấy rằng mỗi bộ lạc có một nền văn hóa thống trị, và các tác giả đã phân loại chúng thành 5 giai đoạn, mỗi giai đoạn có ngôn ngữ, loại hành vi và cấu trúc mối quan hệ độc đáo riêng. Giai đoạn càng cao, hiệu suất tổ chức càng tốt, với Giai đoạn 5 là lý tưởng. Bạn chỉ có thể di chuyển lên các giai đoạn một cách tuần tự, từng giai đoạn một. Ở mỗi giai đoạn, bạn cần sử dụng các điểm đòn bẩy được nhắm mục tiêu, điểm số để nâng cấp bộ lạc của bạn. Mục tiêu là đưa bộ lạc của bạn đến Giai đoạn 4, vì đó là bệ phóng cho Giai đoạn 5.\r\n\r\nCấp độ 1 – Trên bờ vực của sự khủng hoảng\r\n\r\nCấp độ 2 – Cách li và không vướng bận\r\n\r\nCấp độ 3 – Miền tây hoang dã\r\n\r\nCấp độ 4 – Xây dựng thủ lĩnh bộ lạc\r\n\r\nTác giả đã tìm ra điểm khác biệt giữa một bộ lạc trung bình và một bộ lạc thành công chính là văn hoá. Hơn nữa, văn hoá bộ lạc có nhiều cấp độ, từ thiếu hiệu quả đến ích kỉ cá nhân đến vĩ đại. Cuốn sách giải thích tại sao một số bộ lạc từ chối mọi cuộc thảo luận liên quan đến giá trị, tính cách, hay chính trực, trong khi các bộ lạc khác yêu cầu những cuộc thảo luận đó. Thủ lĩnh Bộ lạc phải là người xây dựng bộ lạc của mình, sau đó dừng lại để mọi người có thể tự đạt được sự vĩ đại đó.\r\n\r\n<b>3 bài học về sự phát triển của bộ lạc</b>\r\nTrong thế kỷ 21, các bộ lạc vẫn là những đơn vị xã hội hùng mạnh nhất \r\nSự tiến bộ của bộ lạc phụ thuộc vào chất lượng kết nối giữa các thành viên.\r\nĐể thay đổi một đội nhóm, người lãnh đạo cần làm việc với các cá nhân trước.\r\nKhông có vấn đề gì nếu bạn đã là một nhà lãnh đạo hoặc chỉ bắt đầu mơ ước trở thành một nhà lãnh đạo, cuốn sách này sẽ chỉ ra cách mà các nhà lãnh đạo đánh giá và giúp các đội nhóm của mình tăng năng suất và phát triển. Vì thế, cuốn sách trở thành công cụ đắc lực và thiết yếu đối với những nhà quản lý đang cố gắng tìm ra những điểm độc đáo mà có thể họ chưa từng chú ý tới trước đó. ', 'Tiếng Việt', 182000, 175000),
('SP007', 'DM002', 'Luận Về Đại Chiến Lược', 'TG007', 'NXB004', 2020, 20, 'Cuốn sách kinh điển này khám phá ý nghĩa của “đại chiến lược” bằng cách kể lại những quyết định mang tính định mệnh nhất và cả tồi tệ nhất trong lịch sử. Hầu hết những quyết định ấy đều liên quan đến các cuộc chinh phạt: cuộc xâm lược Hy Lạp của vua Ba Tư Xerxes năm 480 TCN, vua Philip II của Tây Ban Nha xâm lược Anh vào năm 1588, cuộc tấn công của Napoleon vào Nga năm 1812. Qua đây, Gaddis nêu bật sai lầm của việc tập trung vào “khát vọng vô hạn” mà phớt lờ “khả năng có hạn” của mỗi người.\r\n\r\nÔng cũng trích dẫn lời nhà triết học Isaiah Berlin, mượn lời nhà thơ Hy Lạp cổ đại Archilochus, hay kể câu chuyện giữa con cáo, kẻ biết nhiều điều, và con nhím, kẻ biết duy nhất một điều lớn lao… từ đó rút ra kết luận rằng các chiến lược gia vĩ đại được coi là “vĩ đại” vì luôn biết cách tập trung vào các mục tiêu bao quát mà không xa rời thực tế. Tâm trí họ vươn xa nhưng đôi chân luôn chạm đất.\r\n\r\nCuốn sách cũng là lời nhắc nhở thế hệ tương lai rằng nếu lãng quên tư duy đại chiến lược, phía trước bạn ắt sẽ là vũng lầy, bế tắc và những kiểu sai lầm rút cạn nguồn lực của bạn vào các mục tiêu không tưởng.', 'Tiếng Việt', 259000, 241000),
('SP008', 'DM002', 'KPI - Thước Đo Mục Tiêu Trọng Yếu', 'TG008', 'NXB004', 2018, 20, 'KPI - Thước Đo Mục Tiêu Trọng Yếu\r\n\r\n“Cái gì không đo được thì cũng không quản lý được;\r\n\r\nCái gì không đo được thì cũng không cải tiến được.” – Peter Drucker (Cha đẻ Quản trị Kinh doanh hiện đại)\r\n\r\nNhiều nghiên cứu trên khắp thế giới, trong đó có nghiên cứu của Robert Kaplan, Ram Charan, The Balanced Scorecard Institute và Tổ chức FranklinCovey, đã chỉ ra rằng:“70% thất bại của các doanh nghiệp ngày nay không phải là do chiến lược kém hay tầm nhìn sai, mà là do năng lực thực thi và hệ thống triển khai kém hiệu quả.”\r\n\r\nCon số trên cho thấy công tác đo lường hiệu suất công việc (Performance Management) đang được thực hiện thiếu hiệu quả trong rất nhiều tổ chức trên toàn thế giới, từ các tập đoàn đa quốc gia, cơ quan chính phủ cho đến các tổ chức phi lợi nhuận. Họ đã và đang áp dụng các thước đo mục tiêu vốn được đặt ra mà không có bất kỳ sự liên quan nào đến các nhân tố thành công quan trọng của tổ chức mình.\r\n\r\nVậy làm sao để có thể sử dụng các thước đo mục tiêu một cách hiệu quả? KPI – Thước đo mục tiêu trọng yếu (Key Performance Indicator) chính là cuốn sách sẽ cung cấp công cụ và phương pháp để xây dựng hệ thống KPI hiệu quả dành cho mọi cá nhân, bộ phận và tổ chức.\r\n\r\nNằm trong bộ sách “Triển khai chiến lược” do PACE dày công tìm kiếm, nghiên cứu và chọn lọc, có thể nói KPI là quyển sách được thực hiện công phu nhất, đầy đủ nhất và phổ biến nhất hiện nay. Cuốn sách này được biên soạn nhằm hỗ trợ các tổ chức trong việc xây dựng, triển khai và sử dụng hiệu quả các Thước đo Mục tiêu Trọng yếu (Key Performance Indicator; viết tắt KPI) – các thước đo hiệu quả công việc sẽ tạo ra sự khác biệt sâu sắc cho tổ chức của bạn.\r\n\r\nTác giả của quyển sách, David Partmenter, là chuyên gia hàng đầu thế giới trong lĩnh vực KPI, thay thế quy trình hoạch định hàng năm bằng hoạch định cuốn chiếu hàng quý và các thông lệ tài chính tinh gọn. Ông đã phát triển các bước triển khai rõ ràng, giúp các nhà lãnh đạo tránh được những hạn chế trong quá trình sử dụng các KPI và tạo ra các KPI phản ánh một cách có ý nghĩa hiệu suất ngắn hạn và dài hạn của tổ chức.\r\n\r\nViệc triển khai dự án KPI phản ánh văn hóa, trạng thái sẵn sàng cho tương lai của tổ chức, mức độ cam kết của CEO và nhóm quản lý cấp cao, cũng như trình độ chuyên môn của đội ngũ nhân viên được tuyển chọn để tiến hành dự án.\r\n\r\nVới bất kỳ ai quan tâm đến KPI, thì tác phẩm của David Parmenter sẽ là lựa chọn hàng đầu.', 'Tiếng Việt', 195000, 190000),
('SP009', 'DM003', 'Điều Vĩ Đại Đời Thường ', 'TG009', 'NXB002', 2013, 20, 'Điều Vĩ Đại Đời Thường (Đổi Bài Mới)\r\n\r\nHành trình trở nên vĩ đại khởi đầu từ những điều thật giản dị và gần gũi, cũng giống như hành trình vạn dặm khởi đầu từ một bước chân giản đơn. 101 câu chuyện và ý tưởng của tác giả trong quyển sách này chính là 101 bài học minh chứng cho triết lý đơn sơ ấy.\r\nKhông có cuộc sống nào là hoàn hảo, tất cả chúng ta phải đối mặt với nhiều thử thách, từ đơn giản đến nghiêm trọng… Nhưng chúng ta đều có quyền lựa chọn vượt lên mọi nghịch cảnh để vươn tới vị trí cao nhất và tốt nhất của cuộc sống.', 'Tiếng Việt', 80000, 70000),
('SP010', 'DM003', 'Những Cấm Kỵ Khi Giao Tiếp Với Khách Hàng', 'TG010', 'NXB006', 2017, 20, 'Những Cấm Kỵ Khi Giao Tiếp Với Khách Hàng\r\n\r\nKhi gặp gỡ, chăm sóc khách hàng, bạn đã từng có hành động khiến khách hàng khó xử, đã từng rơi vào tình huống kết thúc không vui vẻ?\r\n\r\nKhi giới thiệu sản phẩm với khách hàng, bạn đã từng gặp phải sự bất mãn hay từ chối “mơ hồ” của khách?\r\n\r\nKhi giao tiếp với khách hàng, bạn đã từng nói những câu không thích hợp, khiến khách hàng tức giận, dẫn tới để tuột mất một hợp đồng tưởng đã nằm trong tay?\r\n\r\nKhi giao tiếp với khách hàng, phạm vào điều cấm kị của khách hàng là sơ suất lớn nhất trong bán hàng và phục vụ. Thị trường cạnh tranh hiện nay lấy khách hàng làm trung tâm, cho dù nhân viên bán hàng hay nhân viên phục vụ cũng đều phải học cách giao tiếp với các khách hàng có cá tính khác nhau trong các tình huống khác nhau. Nắm được một vài phương pháp và kĩ năng giao tiếp với khách hàng là điều rất quan trọng. Tuy nhiên, vận dụng phương pháp và kĩ năng tốt tới đâu, nếu phạm vào một điều cấm kị nào đó của khách hàng thì cũng sẽ khiến tất cả nỗ lực trước đó uổng công vô ích. Vì thế, tìm hiểu những điều cấm kị khi giao tiếp với khách hàng, nắm được kiến thức và phương pháp tránh phạm phải cấm kị là kĩ năng mà bất cứ nhân viên nào cũng phải có.\r\n\r\nTrong bán hàng và phục vụ khách hàng tồn tại rất nhiều cấm kị, chỉ có hiểu rõ những cấm kị dễ phạm phải khi giao tiếp với khách hàng mới không vi phạm, mới có thể giao dịch thành công và phục vụ khách hàng tốt hơn. Cuốn sách đã tổng kết những cấm kị dễ phạm phải khi giao tiếp với khách hàng, cơ bản gồm các phương diện: tiếp đón và gặp gỡ khách hàng; giới thiệu sản phẩm; giao dịch và sau giao dịch với khách hàng; phục vụ và xử lí ý kiến bất đồng, khiếu nại, phàn nàn của khách hàng; tâm thái khi giao tiếp với khách hàng; lễ nghi khi giao tiếp với khách hàng...\r\n\r\nCuốn sách có góc nhìn độc đáo, bắt đầu từ góc độ của việc cấm kị, hướng dẫn nhân viên bán hàng và phục vụ khách hàng cách làm việc đúng đắn. Mỗi nội dung trong sách được dẫn dắt bằng tình huống và ví dụ cụ thể, đồng thời phân tích rõ ràng những điều cấm kị dễ phạm phải trong quá trình bán hàng hoặc phục vụ khách hàng, tìm hiểu nguyên nhân và cung cấp phương pháp tránh những điều cấm kị với khách hàng.\r\n\r\nNgoài ra, cuốn sách có nội dung gần với thực tế, không có những khái niệm phức tạp, không có lí luận thuyết giáo khô khan mà dựa vào ví dụ thực tế, giải thích một cách trực tiếp, rõ ràng những vấn đề dễ xuất hiện trong quá trình giao lưu với khách hàng.\r\n\r\nCuốn sách thích hợp với mọi nhân viên trong các doanh nghiệp, có giá trị tham khảo và ý nghĩa chỉ đạo rất lớn với việc nâng cao năng lực giao tiếp của nhân viên, hình thành tố chất nghề nghiệp, nâng cao trình độ văn hóa nghề nghiệp, nâng cao hiệu suất làm việc và chiếm được lòng tin của khách hàng.', 'Tiếng Việt', 98000, 90000),
('SP011', 'DM003', 'Cuộc Sống Của Bạn Đã Tốt Đẹp Chưa?', 'TG011', 'NXB007', 2016, 20, 'Cuộc Sống Của Bạn Đã Tốt Đẹp Chưa?\r\n\r\n\'Cuộc sống của bạn đã tốt đẹp chưa? đưa ra những hướng dẫn đơn giản để bạn tìm ra hướng đi cho mình. Chắc chắn bạn sẽ được Marcia Ullett truyền cảm hứng để thực hiện những thay đổi thực sự trong cuộc đời.\'\r\n\r\n(Hyla Cass, tác giả cuốn 8 Weeks to Vibrant Health)\r\n\r\n\'Trong cuốn sách chân thành và sâu sắc này, Marcia Ullett cung cấp cho bạn bản đồ dẫn đường đến một cuộc sống tốt đẹp hơn cũng như sự hồi phục và hy vọng đòi hỏi phải có lòng can đảm.\'\r\n\r\n(Gary Stromberg, tác giả cuốn The Harder They Fall và Second Chances)\r\n\r\n\'Sử dụng kiến thức đã tiếp thu được cùng những bài học kinh nghiệm của bản thân, Marcia Ullett đưa ra những gợi ý thực tế cho chuyến hành trình hướng đến cuộc sống viên mãn. Cuốn sách mô tả phương pháp đơn giản giúp bạn khám phá một cuộc sống đầy mục đích và đam mê.\'\r\n\r\n(Herb Kaighan, tác giả cuốn Twelve Steps to Spiritual Awakening: Enlightenment for Everyone)', 'Tiếng Việt', 63000, 60000),
('SP012', 'DM003', 'Tự Tin - Nghệ Thuật Giúp Bạn Đạt Được Mọi Mong Muốn', 'TG012', 'NXB005', 2016, 20, 'Tự Tin - Nghệ Thuật Giúp Bạn Đạt Được Mọi Mong Muốn\r\n\r\nSự tự tin sẽ giúp bạn thay đổi cuộc sống cùa mình. Bạn có thể đạt được mọi thứ nếu có lòng tự tin: công việc ưa thích, những cuộc hẹn hò, mức lương hấp dẫn...\r\n\r\nTất cả chúng ta đề có khả năng trở thành người tự tin. Lòng tự tin có thể được nuôi dưỡng và phát triển ở bất kỳ độ tuổi nào, vấn đề là bạn phải có phương pháp đúng.\r\n\r\nCuốn sách này kết hợp những phương pháp hiệu quả nhất trong các lĩnh vực liệu pháp nhận thức hành vi, tâm lý học thể thao, lập trình ngôn ngữ-thần kinh học, tâm lý học tích cực và nhiều lĩnh vực khác. Là một chuyên gia tâm lý và tư vấn trị liệu, tiến sĩ Rob Yeung sẽ hướng dẫn bạn cách chế ngự nỗi sợ hãi, xây dựng lòng tự tin và đạt được những mục tiêu của bản thân trong cuộc sống.\r\n\r\nDù bao nhiêu tuổi, làm nghề gì hay đang trong hoàn cảnh nào, bạn hãy sẵn sàng xây dựng cho mình lòng tự tin sâu sắc và bền vững để đối mặt với bất cứ điều gì trong cuộc sống. Hãy sẵn sàng để vươn tới thành công!\r\n\r\n“Là cuốn sách có tầm quan trọng, có giá trị thực tiễn và có cơ sở khoa học, Tự tin sẽ rất hữu ích cho nhiều người.” - Adrian Furnham, giáo sư Khoa Tâm lý, Đại học London\r\n\r\n“Người tự tin là người gặt hại nhiều thành công hơn. Cuốn sách này hướng dẫn bạn cách trở thành người như vậy.” - Peter Reynolds, Tổng giám đốc Công ty Tư vấn tuyển dụng toàn cầu BBT\r\n\r\nVài nét về tác giả:\r\n\r\nLà một nhà tâm lý học và tư vấn trị liệu, tiến sĩ Rob Yeung đã giúp nhiều người đạt được mục tiêu của mình. Ông được mời nói chuyện tại các buổi hội thảo, tư vấn cho các tổ chức, công ty và hướng dẫn cho nhiều cá nhân. Nổi tiếng với cách làm việc đầy nhiệt huyết và sự hướng dẫn tận tình, ông giúp mọi người có những thay đổi tích cực trong cuộc sống và vươn tới thành công.\r\n\r\nVới tư cách là một diễn giả có đẳng cấp quốc tế, ông đã diễn thuyết trước nhiều cử tọa đa dạng, từ các nhà quản lý doanh nghiệp, doanh nhân đến nhân viên bán hàng và sinh viên đại học. Ông đồng thời là một tác giả với hơn chục đầu sách đã được xuất bản và được dịch ra nhiều thứ tiếng trên khắp thế giới. Ngoài ra, ông còn là một chuyên gia nổi tiếng trên truyền hình (từng xuất hiện trong nhiều chương trình, từ kên truyền hình CNN đến sô diễn Big Brother) cũng như từng xuất hiện với vai trò người dẫn chương trình (kể cả chương trình How To Get Your Dream Job (Làm thế nào để có được công việc như mơ ước) do đài BBC thực hiện).\r\n\r\nMời các bạn đón đọc!\r\n\r\n \r\n\r\n \r\n\r\nMã hàng	9786045850794\r\nNhà Cung Cấp	Cty Nhân Trí Việt\r\nTác giả	Bob Yeung\r\nNgười Dịch	Lê Huy Lâm\r\nNXB	NXB Tổng Hợp TPHCM\r\nNăm XB	2016\r\nTrọng lượng (gr)	350\r\nKích Thước Bao Bì	14 x 21.5\r\nSố trang	273\r\nHình thức	Bìa Mềm\r\nSản phẩm hiển thị trong	\r\nNhân Trí Việt\r\nTâm lý - Kỹ năng sống\r\nTự Tin - Nghệ Thuật Giúp Bạn Đạt Được Mọi Mong Muốn\r\n\r\nSự tự tin sẽ giúp bạn thay đổi cuộc sống cùa mình. Bạn có thể đạt được mọi thứ nếu có lòng tự tin: công việc ưa thích, những cuộc hẹn hò, mức lương hấp dẫn...\r\n\r\nTất cả chúng ta đề có khả năng trở thành người tự tin. Lòng tự tin có thể được nuôi dưỡng và phát triển ở bất kỳ độ tuổi nào, vấn đề là bạn phải có phương pháp đúng.\r\n\r\nCuốn sách này kết hợp những phương pháp hiệu quả nhất trong các lĩnh vực liệu pháp nhận thức hành vi, tâm lý học thể thao, lập trình ngôn ngữ-thần kinh học, tâm lý học tích cực và nhiều lĩnh vực khác. Là một chuyên gia tâm lý và tư vấn trị liệu, tiến sĩ Rob Yeung sẽ hướng dẫn bạn cách chế ngự nỗi sợ hãi, xây dựng lòng tự tin và đạt được những mục tiêu của bản thân trong cuộc sống.\r\n\r\nDù bao nhiêu tuổi, làm nghề gì hay đang trong hoàn cảnh nào, bạn hãy sẵn sàng xây dựng cho mình lòng tự tin sâu sắc và bền vững để đối mặt với bất cứ điều gì trong cuộc sống. Hãy sẵn sàng để vươn tới thành công!\r\n\r\n“Là cuốn sách có tầm quan trọng, có giá trị thực tiễn và có cơ sở khoa học, Tự tin sẽ rất hữu ích cho nhiều người.” - Adrian Furnham, giáo sư Khoa Tâm lý, Đại học London\r\n\r\n“Người tự tin là người gặt hại nhiều thành công hơn. Cuốn sách này hướng dẫn bạn cách trở thành người như vậy.” - Peter Reynolds, Tổng giám đốc Công ty Tư vấn tuyển dụng toàn cầu BBT\r\n\r\nVài nét về tác giả:\r\n\r\nLà một nhà tâm lý học và tư vấn trị liệu, tiến sĩ Rob Yeung đã giúp nhiều người đạt được mục tiêu của mình. Ông được mời nói chuyện tại các buổi hội thảo, tư vấn cho các tổ chức, công ty và hướng dẫn cho nhiều cá nhân. Nổi tiếng với cách làm việc đầy nhiệt huyết và sự hướng dẫn tận tình, ông giúp mọi người có những thay đổi tích cực trong cuộc sống và vươn tới thành công.\r\n\r\nVới tư cách là một diễn giả có đẳng cấp quốc tế, ông đã diễn thuyết trước nhiều cử tọa đa dạng, từ các nhà quản lý doanh nghiệp, doanh nhân đến nhân viên bán hàng và sinh viên đại học. Ông đồng thời là một tác giả với hơn chục đầu sách đã được xuất bản và được dịch ra nhiều thứ tiếng trên khắp thế giới. Ngoài ra, ông còn là một chuyên gia nổi tiếng trên truyền hình (từng xuất hiện trong nhiều chương trình, từ kên truyền hình CNN đến sô diễn Big Brother) cũng như từng xuất hiện với vai trò người dẫn chương trình (kể cả chương trình How To Get Your Dream Job (Làm thế nào để có được công việc như mơ ước) do đài BBC thực hiện).\r\n\r\nMời các bạn đón đọc!', 'Tiếng Việt', 198000, 190000),
('SP013', 'DM004', 'Science Encyclopedia - Bách Khoa Thư Về Khoa Học - Cơ Thể Người', 'TG013', 'NXB008', 2020, 20, 'Các bạn sẽ được bước chân vào một cuộc phiêu lưu kỳ thú để tìm hiểu về cơ chế hoạt động của cơ thể người - một bộ máy kỳ diệu và cực kỳ phức tạp ở trong cuốn sách được minh họa vô cùng tuyệt vời này. Không chỉ vậy, cuốn sách còn là tài liệu ôn tập hữu ích với:\r\n\r\n- Nhiều thí nghiệm, trò chơi và hoạt động được thiết kế để giúp cho việc tiếp cận kiến thức trở nên dễ dàng hơn.\r\n\r\n- Hàng trăm thuật ngữ khoa học đi kèm định nghĩa đầy đủ và dễ hiểu.\r\n\r\n- Hàng trăm website đã qua lựa chọn và kiểm duyệt.\r\n\r\n- Rất nhiều tranh ảnh có thể tải về miễn phí để sử dụng trong quá trình học tập.\r\n\r\nĐây chính là cuốn sách bách khoa tra cứu thuận tiện và dễ dàng ghi nhớ dành cho những bộ óc mê khám phá!', 'Tiếng Việt', 68000, 60000),
('SP014', 'DM004', 'Bách Khoa Tri Thức Về Khám Phá Thế Giới Cho Trẻ Em - Các Ngôi Sao Và Các Hành Tinh', 'TG014', 'NXB009', 2019, 20, 'Bách khoa tri thức về khám phá thế giới cho trẻ em là bộ sách được biên soạn dành riêng cho các bạn nhỏ từ 6 tuổi trở lên. Bộ sách cực kỳ hấp dẫn với:\r\n\r\n- Nội dung đa dạng, thuộc nhiều lĩnh vực từ khoa học tự nhiên đến khoa học xã hội bao gồm thiên văn, động vật, lịch sử, địa chất, thiên nhiên...\r\n\r\n- Ảnh chụp minh họa chân thực, sắc nét có sức tác động mạnh đến thị giác của các bạn nhỏ.\r\n\r\n- Lối viết đơn giản, mạch lạc, kèm theo bảng thuật ngữ giải thích rõ ràng ý nghĩa của các từ chuyên môn trong từng chủ đề.\r\n\r\n- Nhiều trò chơi thú vị giúp các em ôn lại những kiến thức vừa được học. ', 'Tiếng Việt', 55000, 50000),
('SP015', 'DM004', '10 Vạn Câu Hỏi Vì Sao - Cuộc Sống Muôn Màu (Tái Bản 2018)', 'TG015', 'NXB010', 2018, 20, 'Tuổi thơ là khoảng thời gian đẹp nhất trong cuộc đời mỗi người. Ở lứa tuổi này luôn tràn đầy hy vọng, ước mơ, cùng những ngây thơ trong sáng buổi ban đầu. Đứng trước thế giới với bao điều kỳ diệu, mang trong mình sự tò mò, khát vọng tìm hiểu, câu nói thường thấy nhất ở trẻ là “Vì sao?”. Để có thể trả lời chính xác câu hỏi của trẻ, không phải là việc đơn giản. Các nghiên cứu cho thấy, sự phát triển của bộ não trẻ diễn ra nhanh nhất vào tuổi 13 trở về trước, là một phụ huynh, khi không mang lại cho trẻ cơ hội suy nghĩ, tìm hiểu, có thể bạn sẽ phải rất ân hận! Thế giới ngày nay phát triển nhanh chóng, kho tàng kiến thức là vô hạn, luôn được đổi mới với tốc độ chóng mặt.\r\n\r\nCũng xuất phát từ những suy nghĩ trên, bộ sách <b> Mười vạn câu hỏi vì sao</b> mang lại những câu trả lời cho các em theo từng chủ đề mà các em ham tìm hiểu như: vũ trụ, trái đất, con người, thế giới tự nhiên, xã hội, khoa học… Sách sử dụng ngôn ngữ dễ hiểu, kết hợp những hình ảnh minh họa sinh động, sẽ đem đến cho các em những kiến thức cơ bản, chứa đựng nội dung phong phú, khái quát rộng rãi kiến thức xưa nay, giúp các em vui vẻ, thoải mái, tự tin tiến lên trên con đường thành công tương lai.', 'Tiếng Việt', 55000, 50000),
('SP016', 'DM004', 'Bách Khoa Tri Thức Về Khám Phá Thế Giới Cho Trẻ Em - Khủng Long', 'TG016', 'NXB004', 2020, 20, 'Nội dung của bộ sách <b>Bách Khoa Tri Thức Về Khám Phá Thế Giới Cho Trẻ Em</b> đề cập đến rất nhiều những vấn đề mà trẻ muốn biết, từ vũ trụ, trái đất đến giới động vật, thực vật, từ khoa học kỹ thuật đến xã hội cuộc sống. Sách được minh họa bằng những bức tranh sinh động, ngôn ngữ của  đơn giản, dễ hiểu. Mỗi một chủ đề giúp trẻ nhận thức thế giới, tăng cường tri thức, nâng cao khả năng sáng tạo và trí tưởng tượng.\r\n\r\nNgoài ra, sách còn giới thiệu những trang web chứa đựng nhiều thông tin, trò chơi và hoạt động thú vị, cập nhật thêm các tin tức mới nhất về các chủ đề.', 'Tiếng Việt', 45000, 40000),
('SP017', 'DM005', 'Sống Mạo Hiểm Một Cách Cẩn Thận', 'TG017', 'NXB006', 2021, 20, 'Sống Mạo Hiểm Một Cách Cẩn Thận\r\n\r\n<b>Siêu mẫu quốc tế Maye Musk đã chia sẻ những câu chuyện cá nhân cùng các bài học rút ra từ cuộc đời \"Sống mạo hiểm một cách cẩn thận.\"</b>\r\n\r\nMaye Musk là một siêu mẫu thời trang, cuốn hút và thích xê dịch với những mối quan hệ khăng khít, đầy thú vị cùng gia đình và bạn bè - và năm nay bà đã ngoài bảy mươi tuổi. Nhưng mọi thứ không phải lúc nào cũng dễ dàng hay hào nhoáng - bà bắt đầu làm mẹ đơn thân ở tuổi 31, vật lộn với cái nghèo để nuôi dạy cho ba người con; đối mặt với những vấn đề về cân nặng khi làm một người mẫu quá khổ và vượt qua những định kiến về tuổi tác trong ngành người mẫu; đồng thời kiến lập một sự nghiệp trọn đời trong vai trò một chuyên gia dinh dưỡng được trọng vọng, mà trong suốt quá trình đó bà không ngừng bắt đầu lại ở nhiều thành phố khác nhau thuộc ba quốc gia và hai lục địa. Nhưng bà đã vượt qua tất cả với một tinh thần bất khuất và thái độ nghiêm túc để trở thành một người thành công trên toàn cầu ở độ tuổi mà bà gọi là \"đỉnh cao của đời tôi\".\r\n\r\nTrong Sống mạo hiểm một cách cẩn thận, Maye chia sẻ những kinh nghiệm của đời mình, hàm chứa trong đó các triết lý được đúc kết trong gian nan về sự nghiệp (càng chăm chỉ, càng may mắn), gia đình (để người mình yêu thương đi con đường riêng), sức khỏe (không hề có thần dược) và phiêu lưu (luôn tạo không gian cho sự khám phá, nhưng luôn sẵn sàng đón nhận bất kỳ điều gì). Bạn không kiểm soát mọi thứ xảy ra trong đời, nhưng bạn có thể sống cuộc đời mình muốn ở bất kỳ tuổi nào. Tất cả những gì bạn phải làm là lên kế hoạch.\r\n\r\n<b>Một số đánh giá về cuốn sách:</b>\r\n\r\n\"Từ lâu tôi đã ngưỡng mộ Maye Musk cả trong vai trò người mẫu lẫn một người phụ nữ. Bác đã truyền cảm hứng cho nhiều người xuyên suốt sự nghiệp của mình, và những triết lý cùng quan điểm vô giá của bác hiển hiện trên từng trang của cuốn sách này.\"   - Karlie Kloss\r\n\r\n\"Ấm áp, chân thành mà không giả dối, Sống mạo hiểm một cách cẩn thận chứa đầy những quan điểm sâu sắc cùng chất hài hước với hàm lượng hợp lý, mang lại cho người đọc những lời khuyên phải khó khăn lắm mới có được của cả đời người. Maye Musk là người phụ nữ trách nhiệm với hiểu biết rằng cuộc sống đầy những bất ngờ và làm chủ cuộc sống một cách trọn vẹn!\"  - Diane Von Furstenberg\r\n\r\n\"Mỹ nhân phi thường Maye Musk là bằng chứng sống cho thấy một chế độ ăn uống lành mạnh là nền tảng cho một cuộc sống đầy ắp niềm vui, năng động và giàu năng lượng.\"   - Christie Brinkle\r\n\r\n<b>VỀ TÁC GIẢ</b>\r\n\r\nMaye Musk Maye Musk sinh ngày 19 tháng Tư năm 1948 tại Canada. Bà là một siêu mẫu quốc tế, một chuyên gia dinh dưỡng - thực chế học được chứng nhận kiêm diễn giả toàn cầu.\r\n\r\nThời trẻ, bà từng lọt vào chung kết cuộc thi Hoa hậu Nam Phi nhưng nghề chính của bà là bác sĩ dinh dưỡng. Để có thêm tiền trang trải cho cuộc sống, bà còn làm nghề người mẫu.\r\n\r\nNăm 1970, bà kết hôn với ông Errol Musk và có với nhau ba người con, Elon, Kimbal và Tosca (trong đó nổi tiếng nhất chính là tỉ phú Elon Musk). Năm 1979, hai vợ chồng ly hôn và bà trở thành mẹ đơn thân, sau đó chuyển đến Canada sống cùng ba người con. Trong suốt hơn bảy mươi năm cuộc đời, dù trải qua nhiều khó khăn, Maye Musk vẫn nuôi dưỡng ba người con thành tài, có một cuộc sống hạnh phúc cùng sự nghiệp tương đối thành công, cho đến nay vẫn là người mẫu nổi tiếng, được nhiều người ngưỡng mộ.\r\n\r\nBà thường xuyên góp mặt trên những tạp chí thời trang lớn như Vanity Fair, Vogue, Cosmopolitan, Marie Claire và Allure, từng lên trang bìa New York Magazine cùng nhiều người khác. Sinh ra ở Canada, Maye chuyển đến sống ở Nam Phi nhiều năm và hiện tại đang cư ngụ ở Los Angeles, Mỹ.', 'Tiếng Việt', 159000, 150000),
('SP018', 'DM005', 'Chạy Trời Không Khỏi Đau - Nhật Kí Bí Mật Của Một Bác Sĩ Trẻ', 'TG018', 'NXB011', 2021, 20, 'Làm việc 97 giờ mỗi tuần. Phải đưa ra các quyết định sinh tử. Thường xuyên bị nhấn chìm trong những “cơn sóng thần” của máu và dịch cơ thể. Tiền lương nhận được không bằng doanh thu của trụ thu phí đỗ xe.\r\n\r\nChào mừng bạn đến với cuộc sống của một bác sĩ trẻ. Được viết vội sau những giờ làm việc kéo dài như vô tận, những ca trực trắng đêm không một lần chợp mắt và những ngày cuối tuần dành cả cho công việc, nhật kí bí mật của Adam Kay như bản báo cáo không khoan nhượng về thời gian anh đứng trong hàng ngũ bác sĩ tiền tuyến của NHS (Dịch vụ Y tế Quốc gia). Hài hước, choáng váng và đau đớn, cuốn sách này chứa tất cả những gì bạn muốnbiết – và kha khá thứ bạn không muốn biết – về cuộc sống bên trong và bên ngoài bệnh viện.\r\n\r\n“Nếu năm nay bạn chỉ đọc một cuốn sách, hãy đọc cuốn sách này.” Daily Express\r\n\r\n“Quá hài hước và cấp thiết, Chạy trời không khỏi đau phải được kê vào toa thuốc.” Guardian\r\n\r\n“Hài hước đến đớn đau.” Stephenfry\r\n\r\n“Bóp nghẹt con tim.” Jonathan Ross\r\n\r\nAdam Kay hiện là diễn viên hài, biên kịch truyền hình và điện ảnh đã đoạt nhiều giải thưởng. Trước đây anh từng làm việc trong vai trò một bác sĩ trẻ (cơ mà đọc tới cuối sách rồi thì hẳn bạn đã biết thông tin này). Anh đang sống ở Tây London, Vương quốc Anh.', 'Tiếng Việt', 110000, 100000),
('SP019', 'DM005', 'Cuộc Đời Kỳ Lạ Của Nikola Tesla', 'TG019', 'NXB012', 2021, 20, 'Được mệnh danh là “nhà khoa học điên” của giới vật lý, Tesla là người đi tiên phong đưa kỹ thuật điện, điện từ vào đời sống. Với cách tư duy kỳ lạ của mình, ông đã có đến khoảng 300 bằng phát minh, tiêu biểu như động cơ điện không đồng bộ hay lõi Tesla. Rất nhiều phát minh của Tesla đang được ứng dụng trong các thiết bị điện xung quanh ta ngày nay.\r\n\r\nThật không dễ để hiểu thấu hết những gì đang diễn ra trong đầu Tesla, một thiên tài với trí nhớ hình ảnh, biết tám thứ tiếng và có tầm nhìn vượt thời đại. Những gì ông đã viết trong quyển sách này có thể kỳ lạ và khó tin, nhưng hãy nhớ rằng, người ta đã mất gần một thế kỷ để biết những gì Tesla đề xuất là chính xác và khả thi!\r\n\r\nHy vọng quý bạn đọc có thể nhìn ra được điều gì đó mới mẻ trong những câu chữ của Tesla, bởi đó có thể là những hiểu biết giúp ta thay đổi cả thế giới này.', 'Tiếng Việt', 75000, 70000),
('SP020', 'DM005', 'Maria Montessori - Cuộc Đời Và Sự Nghiệp', 'TG020', 'NXB013', 2021, 20, '<b>Maria Montessori Cuộc đời và sự nghiệp</b> cung cấp cho độc giả những kiến thức nền tảng cơ bản về cuộc đời và sự nghiệp của một trong những nhà giáo dục vĩ đại nhất thế kỷ XX – Maria Montessori. Xuất thân trong một gia đình không giàu có với ông bố là một quân nhân nghiêm khắc, Maria không được chiều chuộng như một tiểu thư mà phải tự lập, tự lao động trong một nếp kỷ luật rất nghiêm. Dù cho cha mẹ hướng nghiệp trở thành một nhà giáo nhưng Maria mơ ước trở thành một kỹ sư  rồi sau lại trở thành sinh viên y khoa – những nghề rất lạ lẫm với phụ nữ thời bấy giờ. Vượt qua bao nhiêu rào cản và định kiến, Maria là nữ sinh viên duy nhất được nhận vào học khoa Y của Đại học Rome vào năm 1890. Bà đã nỗ lực học tập và trở thành người phụ nữ đầu tiên nhận bằng Bác sĩ ở nước Ý vào năm 1896 (khi bà 26 tuổi).\r\n\r\nTừ một bác sĩ tâm thần chuyên giúp đỡ những trẻ em chậm phát triển trí tuệ, một cơ duyên tình cờ đã đưa bà đến với sự nghiệp giáo dục trẻ thơ và bản thân bà đã không ngừng khám phá, nghiên cứu và tự hoàn thiện một triết lý giáo dục: <b>hãy tôn trọng trẻ em và tìm cách cư xử với trẻ em một cách tự nhiên nhất có thể</b>. Tác giả Standing ví khám phá của Maria Montessori cũng vĩ đại ngang với Columbus khám phá ra châu Mỹ. Chỉ có điều, thế giới mà Columbus khám phá ra là bên ngoài; còn Montessori đã khám phá ra một thế giới bên trong – bên trong tâm hồn của trẻ em. Xin đừng hiểu lầm về điều này; nó là một khám phá thiên tài về một thứ cũng khách quan như Châu Mỹ đối với Columbus, như Luật Hấp dẫn đối với Newton. Thật sự thì khám phá này mới là thứ đem lại sự nổi tiếng cho bà chứ không phải phương pháp dạy trẻ của bà. Maria Montessori đã khám phá thấy những phẩm chất bình thường của trẻ em cho đến nay vẫn bị che giấu dưới vỏ bọc là những lệch lạc. Maria Montessori đã khám phá ra rằng trẻ em có những phẩm chất khác biệt và cao hơn những gì chúng ta thường gán cho các em.\r\n\r\nTừ một ngôi trường đầu tiên mang tên Casa dei Bambini (Ngôi nhà Trẻ thơ) ở Roma năm 1907, sau hơn một thế kỷ đã có hơn 2.5000 trường học mang tên Montessori với đầy hấp lực từ Âu sang Á, từ Mỹ sang Phi…  Những ghi chép của bà được gọi với tên Phương pháp Montessori ngày nay đã được dịch sang hơn 20 thứ tiếng trên toàn cầu.\r\n\r\n<b>Tác giả</b>\r\n\r\nM. Standing là một trong những người Mỹ đã dành nhiều thời gian ở bên cạnh Maria Montessori và dường như cống hiến phần lớn đời mình với niềm say mê những ý tưởng mới của bà. Ông đã tham dự các bài giảng của Maria Montessori và dịch nhiều cuốn sách của bà sang tiếng Anh. Nếu không có những tác phẩm của ông, những người nói tiếng Anh sẽ không thể tiếp cận được tiểu sử hấp dẫn về cuộc đời Maria Montessori, cũng như không thể có những hiểu biết sâu sắc về các triết lý của bà.\r\n\r\n<b>Dịch giả</b>\r\n\r\nVới bản dịch cuốn sách Maria Montessori Cuộc đời và sự nghiệp này, Nguyễn Bảo Trung không chỉ thể hiện là một người có hiểu biết sâu rộng về triết học, tâm lý học và phân tâm học… mà còn có sự nhiệt tâm và công phu với gần 400 chú thích giúp cho độc giả hiểu sâu và hiểu rộng hơn về cuốn sách này.', 'Tiếng Việt', 200000, 190000);

-- --------------------------------------------------------

--
-- Table structure for table `tac_gia`
--

CREATE TABLE `tac_gia` (
  `id_tac_gia` varchar(10) NOT NULL,
  `ten_tac_gia` varchar(50) NOT NULL,
  `mo_ta_tac_gia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tac_gia`
--

INSERT INTO `tac_gia` (`id_tac_gia`, `ten_tac_gia`, `mo_ta_tac_gia`) VALUES
('TG001', 'Paulo Coelho', ''),
('TG002', 'José Mauro de Vasconcelos', ''),
('TG003', 'Andrew Lang', ''),
('TG004', 'Arundhati Roy', ''),
('TG005', 'Donald J Trump, Tony Schartz', ''),
('TG006', 'Dave Logan, John King, Halee Fis', ''),
('TG007', 'John Lewis Gaddis', ''),
('TG008', 'David Parmenter', ''),
('TG009', 'Robin Sharma, Phạm Anh Tuấn', ''),
('TG010', 'Erin Gruwell và Những Nhà văn Tự do', ''),
('TG011', 'Marcia Ullett', ''),
('TG012', 'Bob Yeung', ''),
('TG013', 'Nhiều Tác Giả', ''),
('TG014', 'Simon Holland', ''),
('TG015', 'Tôn Nguyên Vĩ', ''),
('TG016', 'Rachel Firth', ''),
('TG017', 'Maye Musk', ''),
('TG018', 'Adam Kay', ''),
('TG019', 'Nikola Tesla', ''),
('TG020', 'E M Standing', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD PRIMARY KEY (`id_hoa_don`,`id_san_pham`);

--
-- Indexes for table `chi_tiet_phieu_nhap`
--
ALTER TABLE `chi_tiet_phieu_nhap`
  ADD PRIMARY KEY (`id_phieu_nhap`,`id_sach`);

--
-- Indexes for table `chi_tiet_quyen_chuc_nang`
--
ALTER TABLE `chi_tiet_quyen_chuc_nang`
  ADD PRIMARY KEY (`id_quyen`,`id_chuc_nang`);

--
-- Indexes for table `chuc_nang`
--
ALTER TABLE `chuc_nang`
  ADD PRIMARY KEY (`id_chuc_nang`);

--
-- Indexes for table `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`id_danh_gia`,`id_san_pham`);

--
-- Indexes for table `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`id_danh_muc`);

--
-- Indexes for table `hinh_thuc_giao_hang`
--
ALTER TABLE `hinh_thuc_giao_hang`
  ADD PRIMARY KEY (`id_hinh_thuc`);

--
-- Indexes for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`id_hoa_don`);

--
-- Indexes for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`tai_khoan`);

--
-- Indexes for table `nha_xuat_ban`
--
ALTER TABLE `nha_xuat_ban`
  ADD PRIMARY KEY (`id_nha_xuat_ban`);

--
-- Indexes for table `phieu_nhap`
--
ALTER TABLE `phieu_nhap`
  ADD PRIMARY KEY (`id_phieu_nhap`);

--
-- Indexes for table `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`id_quyen`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id_sale`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id_san_pham`);

--
-- Indexes for table `tac_gia`
--
ALTER TABLE `tac_gia`
  ADD PRIMARY KEY (`id_tac_gia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

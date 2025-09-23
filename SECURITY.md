# Kebijakan Keamanan SIM Dishub

## Versi yang Didukung

Berikut adalah daftar versi SIM Dishub yang masih mendapatkan dukungan pembaruan keamanan:

| Versi | Didukung          | Keterangan |
| ------- | ------------------ | ---------- |
| 3.10.x   | :white_check_mark: | Versi terbaru dengan fitur nodin PKB |
| 3.9.x    | :white_check_mark: | Versi dengan CCTV monitoring |
| 3.8.x    | :white_check_mark: | Versi dengan Google Drive integration |
| 3.0-3.7  | :x:               | Versi lama, harap upgrade |
| < 3.0    | :x:               | Tidak didukung |

## Melaporkan Kerentanan

Jika Anda menemukan kerentanan keamanan pada SIM Dishub, mohon laporkan melalui:

1. **Email**: bot.hunting101@gmail.com
2. **GitHub**: Buat issue baru dengan label "security" di [GitHub Issues](https://github.com/BotHunting/sim_dishub/issues)

### Proses Pelaporan

1. Jelaskan kerentanan yang ditemukan secara detail
2. Sertakan langkah-langkah untuk mereproduksi masalah
3. Lampirkan screenshot atau video jika memungkinkan
4. Berikan saran perbaikan (opsional)

### Respons Tim Keamanan

- Laporan akan ditinjau dalam 2-3 hari kerja
- Update status penanganan akan diberikan setiap minggu
- Perbaikan akan dirilis melalui security patch
- Pelapor akan mendapat credit di changelog

## Praktik Keamanan

1. **Enkripsi Data**
   - Menggunakan HTTPS
   - Password di-hash dengan bcrypt
   - File sensitif dienkripsi

2. **Autentikasi**
   - Multi-factor authentication
   - Session timeout
   - Login attempt limit

3. **Backup & Recovery**
   - Backup otomatis harian
   - Retention period 30 hari
   - Disaster recovery plan

## Kontak

Untuk pertanyaan tentang keamanan:
- 📧 Email: bot.hunting101@gmail.com
- 📱 WhatsApp: +62 812-9032-0438
- 🌐 Website: https://bot-hunting.vercel.app

---
*Dokumen ini terakhir diperbarui: September 2025*

-- Koneksi ke SQL Server menggunakan T-SQL
-- Ganti parameter sesuai dengan konfigurasi server Anda

-- Contoh koneksi menggunakan SQLCMD (dijalankan di terminal/command prompt):
-- sqlcmd -S <server_name> -d <database_name> -U <username> -P <password>

-- Contoh script koneksi di aplikasi (misal menggunakan Python):
-- Pastikan Anda sudah install library pyodbc

import pyodbc

conn = pyodbc.connect(
    'DRIVER={SQL Server};'
    'SERVER=localhost;'
    'DATABASE=dishub_sim;'
    'UID=root;'
    'PWD='
)

cursor = conn.cursor()
cursor.execute("SELECT GETDATE()")
row = cursor.fetchone()
print("Tanggal dan waktu saat ini:", row[0])

conn.close()
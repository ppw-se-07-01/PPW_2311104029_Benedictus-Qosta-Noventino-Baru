const express = require("express");
const Database = require("better-sqlite3");
const bodyParser = require("body-parser");
const cors = require("cors");
const path = require("path");

const app = express();
const port = 3000;

// Middleware
app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Menyajikan file statis dari folder public
app.use(express.static(path.join(__dirname, "public")));

// Konfigurasi Database SQLite
const db = new Database(path.join(__dirname, "kampus.db"));

// Buat tabel mahasiswa jika belum ada
db.exec(`
    CREATE TABLE IF NOT EXISTS mahasiswa (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nim VARCHAR(20) NOT NULL,
        nama VARCHAR(100) NOT NULL,
        jurusan VARCHAR(50) NOT NULL
    )
`);

console.log("✅ Terhubung ke Database SQLite (kampus.db)...");

// --- RESTful API ROUTES ---

// 1. GET: Ambil semua data mahasiswa
app.get("/api/mahasiswa", (req, res) => {
  try {
    const stmt = db.prepare("SELECT * FROM mahasiswa");
    const results = stmt.all();
    res.json(results);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// 2. POST: Tambah data mahasiswa baru
app.post("/api/mahasiswa", (req, res) => {
  const { nim, nama, jurusan } = req.body;
  try {
    const stmt = db.prepare(
      "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES (?, ?, ?)"
    );
    const result = stmt.run(nim, nama, jurusan);
    res.json({
      message: "Data berhasil ditambahkan",
      id: result.lastInsertRowid,
    });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// 3. PUT: Update data mahasiswa
app.put("/api/mahasiswa/:id", (req, res) => {
  const { nim, nama, jurusan } = req.body;
  const { id } = req.params;
  try {
    const stmt = db.prepare(
      "UPDATE mahasiswa SET nim = ?, nama = ?, jurusan = ? WHERE id = ?"
    );
    stmt.run(nim, nama, jurusan, id);
    res.json({ message: "Data berhasil diupdate" });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// 4. DELETE: Hapus data mahasiswa
app.delete("/api/mahasiswa/:id", (req, res) => {
  const { id } = req.params;
  try {
    const stmt = db.prepare("DELETE FROM mahasiswa WHERE id = ?");
    stmt.run(id);
    res.json({ message: "Data berhasil dihapus" });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

app.listen(port, () => {
  console.log(`🚀 Server berjalan di http://localhost:${port}`);
  console.log(`📂 Database: kampus.db`);
});

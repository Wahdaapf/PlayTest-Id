<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Dashboard — PlayTest ID</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Inter', sans-serif; color: #1e293b; background: #f8fafc; font-size: 13px; }

  /* ── Print button (hilang saat print) ── */
  .no-print { padding: 16px 32px; background: #2563eb; color: white; border: none;
              border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;
              display: flex; align-items: center; gap: 8px; }
  .no-print:hover { background: #1d4ed8; }
  .print-bar { position: fixed; top: 0; left: 0; right: 0; z-index: 999;
               background: #1e293b; padding: 10px 24px;
               display: flex; align-items: center; justify-between;
               box-shadow: 0 2px 8px rgba(0,0,0,0.3); }
  .print-bar-title { color: white; font-weight: 600; font-size: 15px; }

  @media print {
    .print-bar { display: none !important; }
    body { background: white; padding-top: 0 !important; }
    .page-break { page-break-before: always; }
  }

  body { padding-top: 56px; }

  /* ── Wrapper ── */
  .wrapper { max-width: 900px; margin: 0 auto; padding: 32px 24px 60px; }

  /* ── Header laporan ── */
  .report-header { display: flex; align-items: flex-start; justify-content: space-between;
                   margin-bottom: 28px; padding-bottom: 20px; border-bottom: 2px solid #2563eb; }
  .report-logo { font-size: 22px; font-weight: 800; color: #2563eb; letter-spacing: -0.5px; }
  .report-logo span { color: #1e293b; }
  .report-meta { text-align: right; }
  .report-meta p { font-size: 12px; color: #64748b; margin-top: 2px; }

  /* ── Section title ── */
  .section-title { font-size: 13px; font-weight: 700; color: #2563eb; text-transform: uppercase;
                   letter-spacing: 0.08em; margin-bottom: 12px; margin-top: 28px;
                   display: flex; align-items: center; gap: 8px; }
  .section-title::after { content: ''; flex: 1; height: 1px; background: #e2e8f0; }

  /* ── Stat cards grid ── */
  .stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 8px; }
  .stat-card { background: white; border-radius: 10px; padding: 14px 16px;
               border: 1px solid #e2e8f0; border-top: 3px solid var(--accent); }
  .stat-card .label { font-size: 10px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.06em; }
  .stat-card .value { font-size: 24px; font-weight: 800; color: #1e293b; margin: 4px 0 2px; line-height: 1; }
  .stat-card .sub   { font-size: 11px; color: #64748b; }

  /* ── Table ── */
  table { width: 100%; border-collapse: collapse; background: white;
          border-radius: 10px; overflow: hidden; border: 1px solid #e2e8f0; }
  thead tr { background: #f8fafc; }
  th { padding: 10px 14px; font-size: 10px; font-weight: 700; color: #94a3b8;
       text-transform: uppercase; letter-spacing: 0.06em; text-align: left;
       border-bottom: 1px solid #e2e8f0; white-space: nowrap; }
  td { padding: 9px 14px; font-size: 12px; color: #475569;
       border-bottom: 1px solid #f1f5f9; }
  tr:last-child td { border-bottom: none; }
  .badge { display: inline-block; padding: 2px 8px; border-radius: 9999px;
           font-size: 10px; font-weight: 600; }
  .badge-developer { background: #eff6ff; color: #1d4ed8; }
  .badge-tester    { background: #f0fdf4; color: #15803d; }
  .badge-admin     { background: #f5f3ff; color: #6d28d9; }
  .badge-aktif, .badge-open, .badge-progress { background: #f0fdf4; color: #16a34a; }
  .badge-selesai   { background: #f5f3ff; color: #6d28d9; }
  .badge-pending   { background: #fffbeb; color: #b45309; }
  .badge-accepted, .badge-success { background: #f0fdf4; color: #16a34a; }
  .badge-rejected  { background: #fef2f2; color: #dc2626; }

  .footer { margin-top: 48px; padding-top: 16px; border-top: 1px solid #e2e8f0;
            text-align: center; font-size: 11px; color: #94a3b8; }
</style>
</head>
<body>

{{-- ── Print Bar ── --}}
<div class="print-bar">
  <span class="print-bar-title">📄 Laporan Dashboard — PlayTest ID</span>
  <button class="no-print" onclick="window.print()">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
      <path d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6z"/>
    </svg>
    Cetak / Save PDF
  </button>
</div>

<div class="wrapper">

  {{-- ── Header laporan ── --}}
  <div class="report-header">
    <div>
      <div class="report-logo">PlayTest<span>ID</span></div>
      <p style="color:#64748b;font-size:12px;margin-top:4px;">Platform Uji Coba Aplikasi</p>
    </div>
    <div class="report-meta">
      <p style="font-size:15px;font-weight:700;color:#1e293b;">Laporan Ringkasan Dashboard</p>
      <p>Dibuat: {{ now()->format('d F Y, H:i') }} WIB</p>
      <p>Oleh: Admin PlayTest ID</p>
    </div>
  </div>

  {{-- ── Statistik Utama ── --}}
  <div class="section-title">Statistik Utama Platform</div>
  <div class="stat-grid">
    <div class="stat-card" style="--accent:#2563eb;">
      <div class="label">Total Developer</div>
      <div class="value">{{ number_format($statDeveloper) }}</div>
      <div class="sub">+{{ $devBulanIni }} bulan ini</div>
    </div>
    <div class="stat-card" style="--accent:#10b981;">
      <div class="label">Total Tester</div>
      <div class="value">{{ number_format($statTester) }}</div>
      <div class="sub">+{{ $testerBulanIni }} bulan ini</div>
    </div>
    <div class="stat-card" style="--accent:#f59e0b;">
      <div class="label">Kampanye Aktif</div>
      <div class="value">{{ number_format($statAktif) }}</div>
      <div class="sub">Sedang berjalan</div>
    </div>
    <div class="stat-card" style="--accent:#8b5cf6;">
      <div class="label">Kampanye Selesai</div>
      <div class="value">{{ number_format($statSelesai) }}</div>
      <div class="sub">Total diselesaikan</div>
    </div>
    <div class="stat-card" style="--accent:#10b981;">
      <div class="label">Total Pendapatan</div>
      <div class="value" style="font-size:18px;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
      <div class="sub">Dari semua transaksi</div>
    </div>
    <div class="stat-card" style="--accent:#ef4444;">
      <div class="label">Pending Review</div>
      <div class="value" style="color:#ef4444;">{{ number_format($statPending) }}</div>
      <div class="sub">Perlu tindakan admin</div>
    </div>
  </div>

  {{-- ── Daftar Pengguna ── --}}
  <div class="section-title page-break">Daftar Pengguna (20 Terbaru)</div>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Tanggal Daftar</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $i => $u)
      <tr>
        <td style="color:#94a3b8;">{{ $i + 1 }}</td>
        <td style="font-weight:500;color:#1e293b;">{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>
          @php $r = strtolower($u->role->value ?? $u->role); @endphp
          <span class="badge badge-{{ $r }}">{{ ucfirst($r) }}</span>
        </td>
        <td>{{ $u->created_at->format('d M Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{-- ── Kampanye Terbaru ── --}}
  <div class="section-title page-break">Kampanye Terbaru (10 Terakhir)</div>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Nama Aplikasi</th>
        <th>Developer</th>
        <th>Status</th>
        <th>Kapasitas</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($kampanye as $i => $m)
      <tr>
        <td style="color:#94a3b8;">{{ $i + 1 }}</td>
        <td style="font-weight:500;color:#1e293b;">{{ $m->nama_aplikasi }}</td>
        <td>{{ $m->user->name ?? 'Unknown' }}</td>
        <td>
          @php $st = strtolower($m->status); @endphp
          <span class="badge badge-{{ $st }}">{{ ucfirst($st) }}</span>
        </td>
        <td>{{ $m->kapasitas ?? '-' }}</td>
        <td>{{ $m->created_at->format('d M Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{-- ── Riwayat Pendapatan ── --}}
  <div class="section-title page-break">Riwayat Pendapatan (10 Terbaru)</div>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Pengguna</th>
        <th>Paket</th>
        <th>Harga</th>
        <th>Fee</th>
        <th>Total</th>
        <th>Status</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pembayarans as $i => $p)
      @php
        $harga = $p->paket->price ?? 0;
        $fee   = $p->paket->fee ?? 0;
        $total = $harga + $fee;
        $st    = strtolower($p->status);
      @endphp
      <tr>
        <td style="color:#94a3b8;">{{ $i + 1 }}</td>
        <td style="font-weight:500;color:#1e293b;">{{ $p->user->name ?? 'Unknown' }}</td>
        <td>{{ $p->paket->name ?? '-' }}</td>
        <td>Rp {{ number_format($harga, 0, ',', '.') }}</td>
        <td>Rp {{ number_format($fee, 0, ',', '.') }}</td>
        <td style="font-weight:600;color:#1e293b;">Rp {{ number_format($total, 0, ',', '.') }}</td>
        <td><span class="badge badge-{{ $st }}">{{ ucfirst($st) }}</span></td>
        <td>{{ $p->created_at->format('d M Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{-- ── Footer ── --}}
  <div class="footer">
    Laporan ini dibuat secara otomatis oleh sistem PlayTest ID pada {{ now()->format('d F Y \p\u\k\u\l H:i') }} WIB.
    Bersifat rahasia dan hanya untuk penggunaan internal admin.
  </div>
</div>

</body>
</html>

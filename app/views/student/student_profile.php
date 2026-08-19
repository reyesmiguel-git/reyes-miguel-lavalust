<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reyes Miguel Ramos | Student Profile</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: #f2f7fb;
            color: #193a54;
        }
        .page {
            width: min(900px, calc(100% - 32px));
            margin: 0 auto;
            padding: 40px 0;
        }
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 22px;
        }
        .brand { font-weight: 800; font-size: 18px; }
        .links { display: flex; gap: 10px; flex-wrap: wrap; }
        .links a {
            text-decoration: none;
            color: #124f82;
            background: white;
            border: 1px solid #d8e8f5;
            padding: 10px 15px;
            border-radius: 10px;
            font-weight: 700;
        }
        .links a.active { background: #124f82; color: white; border-color: #124f82; }
        .profile-card {
            overflow: hidden;
            border-radius: 24px;
            background: white;
            border: 1px solid #dce8f1;
            box-shadow: 0 18px 50px rgba(20, 58, 87, .10);
        }
        .top {
            padding: 32px;
            background: linear-gradient(120deg, #123f67, #0e725d);
            color: white;
        }
        .verified {
            display: inline-block;
            background: rgba(255,255,255,.16);
            border: 1px solid rgba(255,255,255,.28);
            padding: 7px 11px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 13px;
        }
        h1 { margin: 0 0 6px; font-size: clamp(29px, 5vw, 43px); }
        .course-line { margin: 0; opacity: .88; font-weight: 650; }
        .content { padding: 30px 32px 34px; }
        .middleware {
            margin-bottom: 24px;
            background: #eaf8f3;
            border: 1px solid #ccece1;
            color: #145d4d;
            border-radius: 13px;
            padding: 14px 16px;
            line-height: 1.5;
            font-weight: 650;
        }
        .details {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }
        .item {
            padding: 17px;
            border: 1px solid #e3edf4;
            background: #fafcfe;
            border-radius: 14px;
        }
        .label { display: block; color: #7a8fa1; font-size: 12px; text-transform: uppercase; letter-spacing: .8px; font-weight: 800; margin-bottom: 6px; }
        .value { display: block; color: #173c59; font-weight: 800; line-height: 1.4; word-break: break-word; }
        @media (max-width: 650px) {
            .page { padding: 24px 0; }
            .nav { align-items: flex-start; flex-direction: column; }
            .top, .content { padding: 24px 20px; }
            .details { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <main class="page">
        <nav class="nav">
            <div class="brand">Reyes Student Portal</div>
            <div class="links">
                <a href="<?= site_url('student'); ?>">Home</a>
                <a class="active" href="<?= site_url('student/profile'); ?>">Student Profile</a>
            </div>
        </nav>

        <section class="profile-card">
            <div class="top">
                <span class="verified">Student Profile · Middleware Protected</span>
                <h1><?= htmlspecialchars($name); ?></h1>
                <p class="course-line"><?= htmlspecialchars($course); ?> · <?= htmlspecialchars($year); ?> · Section <?= htmlspecialchars($section); ?></p>
            </div>

            <div class="content">
                <div class="middleware"><?= htmlspecialchars($middleware_message, ENT_QUOTES, 'UTF-8'); ?></div>

                <div class="details">
                    <div class="item"><span class="label">Student ID</span><span class="value"><?= htmlspecialchars($student_id); ?></span></div>
                    <div class="item"><span class="label">Student Name</span><span class="value"><?= htmlspecialchars($name); ?></span></div>
                    <div class="item"><span class="label">Course</span><span class="value"><?= htmlspecialchars($course); ?></span></div>
                    <div class="item"><span class="label">Year Level</span><span class="value"><?= htmlspecialchars($year); ?></span></div>
                    <div class="item"><span class="label">Section</span><span class="value"><?= htmlspecialchars($section); ?></span></div>
                    <div class="item"><span class="label">Email</span><span class="value"><?= htmlspecialchars($email); ?></span></div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

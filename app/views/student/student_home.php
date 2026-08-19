<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reyes Student Information Portal</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #eef5ff 0%, #f8fbff 50%, #edfdf7 100%);
            color: #18324a;
        }
        .page {
            width: min(920px, calc(100% - 32px));
            margin: 0 auto;
            padding: 42px 0;
        }
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }
        .brand { font-weight: 800; font-size: 18px; letter-spacing: .3px; }
        .links { display: flex; gap: 10px; flex-wrap: wrap; }
        .links a {
            text-decoration: none;
            color: #124f82;
            background: #ffffff;
            border: 1px solid #d8e8f5;
            padding: 10px 15px;
            border-radius: 10px;
            font-weight: 700;
        }
        .links a.active { background: #124f82; color: white; border-color: #124f82; }
        .card {
            background: rgba(255,255,255,.95);
            border: 1px solid #dfeaf3;
            border-radius: 24px;
            padding: 34px;
            box-shadow: 0 18px 50px rgba(21, 62, 92, .10);
        }
        .eyebrow {
            display: inline-block;
            color: #0c6b52;
            background: #e7f8f2;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 14px;
        }
        h1 { margin: 0 0 10px; font-size: clamp(30px, 5vw, 48px); color: #123d63; }
        .subtitle { margin: 0 0 28px; color: #587085; line-height: 1.65; }
        .notice {
            margin-bottom: 22px;
            background: #fff0f0;
            color: #9b1c1c;
            border: 1px solid #f2b8b8;
            border-left: 5px solid #c62828;
            border-radius: 12px;
            padding: 14px 16px;
            line-height: 1.5;
            font-weight: 700;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 26px;
        }
        .info {
            background: #f7fbff;
            border: 1px solid #e0edf6;
            border-radius: 14px;
            padding: 16px;
        }
        .label { display: block; font-size: 12px; text-transform: uppercase; letter-spacing: .8px; color: #7890a4; margin-bottom: 6px; font-weight: 800; }
        .value { font-size: 16px; font-weight: 750; color: #173d5b; word-break: break-word; }
        .button {
            display: inline-block;
            text-decoration: none;
            background: #0f6f5b;
            color: white;
            padding: 13px 20px;
            border-radius: 11px;
            font-weight: 800;
        }
        .foot { margin-top: 18px; color: #718799; font-size: 13px; }
        @media (max-width: 650px) {
            .page { padding: 24px 0; }
            .nav { align-items: flex-start; flex-direction: column; }
            .card { padding: 24px 20px; }
            .info-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <main class="page">
        <nav class="nav">
            <div class="brand">Reyes Student Portal</div>
            <div class="links">
                <a class="active" href="<?= site_url('student'); ?>">Home</a>
                <a href="<?= site_url('student/profile'); ?>">Student Profile</a>
            </div>
        </nav>

        <section class="card">
            <span class="eyebrow">Student Information</span>
            <h1>Welcome, Miguel.</h1>
            <p class="subtitle">This page demonstrates LavaLust routing, controller-to-view data passing, navigation, and middleware-protected profile access.</p>

            <?php if (!empty($notice)): ?>
                <div class="notice"><?= htmlspecialchars($notice, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>

            <div class="info-grid">
                <div class="info"><span class="label">Student ID</span><span class="value"><?= htmlspecialchars($student_id); ?></span></div>
                <div class="info"><span class="label">Student Name</span><span class="value"><?= htmlspecialchars($name); ?></span></div>
                <div class="info"><span class="label">Course</span><span class="value"><?= htmlspecialchars($course); ?></span></div>
                <div class="info"><span class="label">Year Level</span><span class="value"><?= htmlspecialchars($year); ?></span></div>
                <div class="info"><span class="label">Section</span><span class="value"><?= htmlspecialchars($section); ?></span></div>
                <div class="info"><span class="label">Email</span><span class="value"><?= htmlspecialchars($email); ?></span></div>
            </div>

            <a class="button" href="<?= site_url('student/open-profile'); ?>">Open Protected Profile</a>
            <div class="foot">StudentMiddleware allows /student/profile only after the Open Protected Profile button is clicked. Typing the profile URL directly will be denied.</div>
        </section>
    </main>
</body>
</html>

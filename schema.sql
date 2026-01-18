
CREATE TABLE classrooms (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    year VARCHAR(20) NOT NULL
);

CREATE TABLE skills (
    id SERIAL PRIMARY KEY,
    code VARCHAR(10) UNIQUE NOT NULL,
    label VARCHAR(255) NOT NULL
);

-- 3. USERS TABLE
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    last_name VARCHAR(100) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL CHECK (role IN ('ADMIN', 'TEACHER', 'STUDENT')),
    classroom_id INT, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_user_classroom FOREIGN KEY (classroom_id) 
        REFERENCES classrooms(id) ON DELETE SET NULL
);

-- 4. PEDAGOGICAL STRUCTURE
CREATE TABLE sprints (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    duration VARCHAR(50),
    chronological_order INT NOT NULL,
    classroom_id INT NOT NULL,
    CONSTRAINT fk_sprint_classroom FOREIGN KEY (classroom_id) 
        REFERENCES classrooms(id) ON DELETE CASCADE
);

CREATE TABLE briefs (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    estimated_duration VARCHAR(50),
    brief_type VARCHAR(20) NOT NULL CHECK (brief_type IN ('INDIVIDUAL', 'COLLECTIVE')),
    sprint_id INT NOT NULL,
    CONSTRAINT fk_brief_sprint FOREIGN KEY (sprint_id) 
        REFERENCES sprints(id) ON DELETE CASCADE
);

-- 5. RELATIONSHIP TABLES (Many-to-Many)
CREATE TABLE brief_skill (
    brief_id INT NOT NULL,
    skill_id INT NOT NULL,
    PRIMARY KEY (brief_id, skill_id),
    CONSTRAINT fk_bs_brief FOREIGN KEY (brief_id) REFERENCES briefs(id) ON DELETE CASCADE,
    CONSTRAINT fk_bs_skill FOREIGN KEY (skill_id) REFERENCES skills(id) ON DELETE CASCADE
);

CREATE TABLE classroom_teacher (
    classroom_id INT NOT NULL,
    teacher_id INT NOT NULL,
    PRIMARY KEY (classroom_id, teacher_id),
    CONSTRAINT fk_ct_classroom FOREIGN KEY (classroom_id) REFERENCES classrooms(id) ON DELETE CASCADE,
    CONSTRAINT fk_ct_teacher FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 6. EVALUATIONS (The History Table)
CREATE TABLE evaluations (
    id SERIAL PRIMARY KEY,
    student_id INT NOT NULL,
    teacher_id INT NOT NULL,
    brief_id INT NOT NULL,
    skill_id INT NOT NULL,
    mastery_level VARCHAR(20) NOT NULL CHECK (mastery_level IN ('IMITATE', 'ADAPT', 'TRANSPOSE')),
    comment TEXT,
    evaluation_date DATE DEFAULT CURRENT_DATE,
    CONSTRAINT fk_eval_student FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_eval_teacher FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_eval_brief FOREIGN KEY (brief_id) REFERENCES briefs(id) ON DELETE CASCADE,
    CONSTRAINT fk_eval_skill FOREIGN KEY (skill_id) REFERENCES skills(id) ON DELETE CASCADE
);
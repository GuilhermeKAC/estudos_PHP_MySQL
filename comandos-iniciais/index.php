<?php

# Conexão com o DB MySQL ****************************************************

$servidor ="localhost";
$usuario = "root";
$senha = "";
$database = "aula_php";

$conexao = mysqli_connect($servidor, $usuario, $senha, $database);

if($conexao) {
    echo "Conectado com sucesso<br>";
} else {
    echo "Erro de conexão<br>";
}

# Criando Tabelas usando PHP ****************************************************

# Tabela cursos (nome do curso, carga horaria)

$query = "create table cursos(
    id_curso int not null auto_increment,
    nome_curso varchar(255) not null,
    carga_horaria int not null,
    primary key(id_aluno)
)";

$executar = mysqli_query($conexao, $query);

# Tabela alunos (nome do aluno, data de nascimento)

$query = "create table alunos(
    id_aluno int not null auto_increment,
    nome_aluno varchar(255) not null,
    data_nascimento date,
    primary key(id_aluno)
)";

$executar = mysqli_query($conexao, $query);

# Tabela aluno_cursos (aluno, curso)

$query = "create table alunos_cursos(
    id_aluno_curso int not null auto_increment,
    id_aluno int not null,
    id_curso int not null,
    primary key(id_aluno_curso)
)";

$executar = mysqli_query($conexao, $query);

# Inserindo dados nas Tabelas ****************************************************

# Tabela alunos (nome do aluno, data de nascimento)

$query = "insert into alunos(nome_aluno, data_nascimento) values
    ('Guilherme', '1991-14-12')";

$executar = mysqli_query($conexao, $query);

$query = "insert into alunos(nome_aluno, data_nascimento) values
    ('Ana', '1995-14-12')";

$executar = mysqli_query($conexao, $query);

# Tabela cursos (nome do curso, carga horaria)

$query = "insert into cursos(nome_curso, carga_horaria) values
    ('PHP', 10)";

$executar = mysqli_query($conexao, $query);

$query = "insert into cursos(nome_curso, carga_horaria) values
    ('MySQL', 8)";

$executar = mysqli_query($conexao, $query);

# Tabela aluno_cursos (aluno, curso)

$query = "insert into alunos_cursos(id_aluno, id_curso) values
    (1, 1)";

$executar = mysqli_query($conexao, $query);

$query = "insert into alunos_cursos(id_aluno, id_curso) values
    (3, 2)";

$executar = mysqli_query($conexao, $query);

# Deletando dados nas Tabelas ****************************************************

if(mysqli_query($conexao, "delete from alunos where id_aluno = 2")) {
    echo "Apagado com sucesso";
} else {
    echo "Erro ao apagar";
}

# Alterando dados nas Tabelas ****************************************************

if(mysqli_query($conexao, "update alunos set nome_aluno = 'Guilherme Kruszynski' where id_aluno = 1")) {
    echo "Dado alterado com sucesso<br>";
} else {
    echo "Erro ao alterar dado<br>";
}

if(mysqli_query($conexao, "update alunos set nome_aluno = 'Ana Paula' where id_aluno = 3")) {
    echo "Dado alterado com sucesso<br>";
} else {
    echo "Erro ao alterar dado<br>";
}

# Consultando dados nas Tabelas ****************************************************

echo '
    <table border=1>
        <tr>
            <th>id</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
        </tr>
        ';

$consulta = mysqli_query($conexao, "select * from alunos");

while($linha = mysqli_fetch_array($consulta)){
    echo '<tr><td>'. $linha['id_aluno'].'</td>';
    echo '<td>'. $linha['nome_aluno']. '</td>';
    echo '<td>'. $linha['data_nascimento']. '</td></tr>';
}   

echo '</table>';

# Alterando id de uma Tabela ****************************************************

mysqli_query($conexao, "alter table cursos change id id_curso int not null auto_increment");

# SELECT ****************************************************

$consulta = mysqli_query($conexao, "
    select alunos.nome_aluno, cursos.nome_curso from alunos, cursos, alunos_cursos
    where alunos_cursos.id_aluno = alunos.id_aluno
    and alunos_cursos.id_curso = cursos.id_curso;");

echo '
<table border=1>
    <tr>
        <th>Nome do aluno</th>
        <th>Nome do curso</th>
    </tr>
    ';

while($linha = mysqli_fetch_array($consulta)){
    echo '<tr><td>'. $linha['nome_aluno'].'</td>';
    echo '<td>'. $linha['nome_curso']. '</td></tr>';
}   

echo '</table>';

?>
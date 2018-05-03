## Alterar siteurl e homeurl

```UPDATE wp_options
SET option_value = replace(option_value, 'http://www.enderecoantigo.com', 'http://www.endereconovo.com')
WHERE option_name = 'home'
OR option_name = 'siteurl';
```

## Alterar GUID
```UPDATE wp_posts
SET guid = REPLACE (guid, 'http://www.enderecoantigo.com', 'http://www.endereconovo.com');
```

## Alterar URL no conteúdo
```UPDATE wp_posts
SET post_content = REPLACE (post_content, 'http://www.enderecoantigo.com', 'http://www.endereconovo.com');
```

## Alterar apenas o caminho das imagens
```UPDATE wp_posts
SET post_content = REPLACE (post_content, 'src="http://www.enderecoantigo.com', 'src="http://www.endereconovo.com');
```

```UPDATE wp_posts
SET guid = REPLACE (guid, 'http://www.enderecoantigo.com', 'http://www.endereconovo.com') 
WHERE post_type = 'attachment';
```

## Atualizar Post Meta
```UPDATE wp_postmeta
SET meta_value = REPLACE (meta_value, 'http://www.enderecoantigo.com','http://www.endereconovo.com');
```

## Alterar o nome usuário padrão “admin”
```UPDATE wp_users
SET user_login = 'nomequevocequiser'
WHERE user_login = 'Admin';
```

## Resetar password
```UPDATE wp_users
SET user_pass = MD5('senha')
WHERE user_login = 'login';
```

## Transferir artigos de um autor para outro
```UPDATE wp_posts
SET post_author = 'id_novo_autor'
WHERE post_author = 'id_autor_antigo';
```

## Apagar revisões
```DELETE a,b,c FROM wp_posts a
LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id)
LEFT JOIN wp_postmeta c ON (a.ID = c.post_id)
WHERE a.post_type = 'revision';
```

## Apagar post meta
```DELETE FROM wp_postmeta
WHERE meta_key = 'nome-chave-meta';
```

## Exportar todos os e-mails de comentários
```SELECT DISTINCT comment_author_email
FROM wp_comments;
```

## Apagar todos pingbacks
```DELETE FROM wp_comments 
WHERE comment_type = 'pingback';
```

## Apagar todos comentários de SPAM
```DELETE FROM wp_comments 
WHERE comment_approved = 'spam';
```

## Identificar tags não usadas
```SELECT * From wp_terms wt
INNER JOIN wp_term_taxonomy wtt
ON wt.term_id=wtt.term_id
WHERE wtt.taxonomy='post_tag'
AND wtt.count=0;
```

**Fonte:** http://desenvolvimentoparaweb.com/wordpress/15-comandos-sql-wordpress/

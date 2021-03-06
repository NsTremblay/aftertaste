PGDMP     2    ,                s           ntrem018    8.4.17    9.4.0 G    N           0    0    ENCODING    ENCODING         SET client_encoding = 'LATIN1';
                       false            O           0    0 
   STDSTRINGS 
   STDSTRINGS     )   SET standard_conforming_strings = 'off';
                       false            P           1262    1594287    ntrem018    DATABASE     h   CREATE DATABASE ntrem018 WITH TEMPLATE = template0 ENCODING = 'LATIN1' LC_COLLATE = 'C' LC_CTYPE = 'C';
    DROP DATABASE ntrem018;
             ntrem018    false                        2615    1750732    A2    SCHEMA        CREATE SCHEMA "A2";
    DROP SCHEMA "A2";
             ntrem018    false                        2615    1750699    PostgreSQLCanSchema    SCHEMA     %   CREATE SCHEMA "PostgreSQLCanSchema";
 #   DROP SCHEMA "PostgreSQLCanSchema";
             ntrem018    false                        2615    2037303 
   aftertaste    SCHEMA        CREATE SCHEMA aftertaste;
    DROP SCHEMA aftertaste;
             ntrem018    false            
            2615    1796978    edalp005    SCHEMA        CREATE SCHEMA edalp005;
    DROP SCHEMA edalp005;
             ntrem018    false                        2615    1628641    ntrem018    SCHEMA        CREATE SCHEMA ntrem018;
    DROP SCHEMA ntrem018;
             ntrem018    false            Q           0    0    SCHEMA ntrem018    COMMENT     A   COMMENT ON SCHEMA ntrem018 IS 'This is the new Schema for lab2';
                  ntrem018    false    5            	            2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             pgsql    false            R           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  pgsql    false    9            S           0    0    public    ACL     �   REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM pgsql;
GRANT ALL ON SCHEMA public TO pgsql;
GRANT ALL ON SCHEMA public TO PUBLIC;
                  pgsql    false    9            �           2612    27735    plpgsql    PROCEDURAL LANGUAGE     /   CREATE OR REPLACE PROCEDURAL LANGUAGE plpgsql;
 "   DROP PROCEDURAL LANGUAGE plpgsql;
             pgsql    false            �            1255    27736    plpgsql_call_handler()    FUNCTION     �   CREATE FUNCTION plpgsql_call_handler() RETURNS language_handler
    LANGUAGE c
    AS '$libdir/plpgsql', 'plpgsql_call_handler';
 -   DROP FUNCTION public.plpgsql_call_handler();
       public       pgsql    false    9            �            1259    2037746    location    TABLE     �   CREATE TABLE location (
    fodate date,
    pnumber text,
    saddress text,
    hopen date,
    hclose date,
    id integer NOT NULL,
    restid integer,
    coordinates text,
    userid integer,
    manager text
);
    DROP TABLE ntrem018.location;
       ntrem018         ntrem018    false    5            �            1259    2087043    location_id_seq    SEQUENCE     q   CREATE SEQUENCE location_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE ntrem018.location_id_seq;
       ntrem018       ntrem018    false    150    5            T           0    0    location_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE location_id_seq OWNED BY location.id;
            ntrem018       ntrem018    false    153            �            1259    2037733    menuitem    TABLE     �   CREATE TABLE menuitem (
    name text,
    type text,
    category text,
    description text,
    price real,
    id integer NOT NULL,
    restid integer,
    userid integer
);
    DROP TABLE ntrem018.menuitem;
       ntrem018         ntrem018    false    5            �            1259    2084573    menuitem_id_seq    SEQUENCE     q   CREATE SEQUENCE menuitem_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE ntrem018.menuitem_id_seq;
       ntrem018       ntrem018    false    149    5            U           0    0    menuitem_id_seq    SEQUENCE OWNED BY     5   ALTER SEQUENCE menuitem_id_seq OWNED BY menuitem.id;
            ntrem018       ntrem018    false    152            �            1259    2037705    rater    TABLE     �   CREATE TABLE rater (
    email text,
    name text NOT NULL,
    jdate date,
    type character(20),
    reputation integer DEFAULT 1,
    userid integer NOT NULL,
    pass text
);
    DROP TABLE ntrem018.rater;
       ntrem018         ntrem018    false    5            �            1259    2129907    rater_userid_seq    SEQUENCE     r   CREATE SEQUENCE rater_userid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE ntrem018.rater_userid_seq;
       ntrem018       ntrem018    false    146    5            V           0    0    rater_userid_seq    SEQUENCE OWNED BY     7   ALTER SEQUENCE rater_userid_seq OWNED BY rater.userid;
            ntrem018       ntrem018    false    158            �            1259    2037715    rating    TABLE     �   CREATE TABLE rating (
    date date NOT NULL,
    price integer,
    food integer,
    mood integer,
    staff integer,
    comments text,
    raterid integer,
    restid integer NOT NULL,
    userid integer NOT NULL,
    id integer NOT NULL
);
    DROP TABLE ntrem018.rating;
       ntrem018         ntrem018    false    5            �            1259    2148920    rating_id_seq    SEQUENCE     o   CREATE SEQUENCE rating_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE ntrem018.rating_id_seq;
       ntrem018       ntrem018    false    5    148            W           0    0    rating_id_seq    SEQUENCE OWNED BY     1   ALTER SEQUENCE rating_id_seq OWNED BY rating.id;
            ntrem018       ntrem018    false    159            �            1259    2121663 
   ratingitem    TABLE     �   CREATE TABLE ratingitem (
    userid integer NOT NULL,
    date date NOT NULL,
    itemid integer NOT NULL,
    comment text,
    rating integer,
    menuitemid integer,
    ratingid integer
);
     DROP TABLE ntrem018.ratingitem;
       ntrem018         ntrem018    false    5            �            1259    2121661    ratingitem_itemid_seq    SEQUENCE     w   CREATE SEQUENCE ratingitem_itemid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE ntrem018.ratingitem_itemid_seq;
       ntrem018       ntrem018    false    5    157            X           0    0    ratingitem_itemid_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE ratingitem_itemid_seq OWNED BY ratingitem.itemid;
            ntrem018       ntrem018    false    156            �            1259    2037710 
   restaurant    TABLE     s   CREATE TABLE restaurant (
    name text,
    type character(20),
    url character(50),
    id integer NOT NULL
);
     DROP TABLE ntrem018.restaurant;
       ntrem018         ntrem018    false    5            �            1259    2066935    restaurant_id_seq    SEQUENCE     s   CREATE SEQUENCE restaurant_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE ntrem018.restaurant_id_seq;
       ntrem018       ntrem018    false    5    147            Y           0    0    restaurant_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE restaurant_id_seq OWNED BY restaurant.id;
            ntrem018       ntrem018    false    151            �            1259    2101680    times    TABLE     �   CREATE TABLE times (
    id integer NOT NULL,
    open character(7),
    close character(7),
    restid integer,
    "time" character(3)
);
    DROP TABLE ntrem018.times;
       ntrem018         ntrem018    false    5            �            1259    2101678    times_id_seq    SEQUENCE     n   CREATE SEQUENCE times_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE ntrem018.times_id_seq;
       ntrem018       ntrem018    false    155    5            Z           0    0    times_id_seq    SEQUENCE OWNED BY     /   ALTER SEQUENCE times_id_seq OWNED BY times.id;
            ntrem018       ntrem018    false    154            �            1259    1615331    distributors    TABLE        CREATE TABLE distributors (
);
     DROP TABLE public.distributors;
       public         ntrem018    false    9            �           2604    2087045    id    DEFAULT     \   ALTER TABLE ONLY location ALTER COLUMN id SET DEFAULT nextval('location_id_seq'::regclass);
 <   ALTER TABLE ntrem018.location ALTER COLUMN id DROP DEFAULT;
       ntrem018       ntrem018    false    153    150            �           2604    2084575    id    DEFAULT     \   ALTER TABLE ONLY menuitem ALTER COLUMN id SET DEFAULT nextval('menuitem_id_seq'::regclass);
 <   ALTER TABLE ntrem018.menuitem ALTER COLUMN id DROP DEFAULT;
       ntrem018       ntrem018    false    152    149            �           2604    2129909    userid    DEFAULT     ^   ALTER TABLE ONLY rater ALTER COLUMN userid SET DEFAULT nextval('rater_userid_seq'::regclass);
 =   ALTER TABLE ntrem018.rater ALTER COLUMN userid DROP DEFAULT;
       ntrem018       ntrem018    false    158    146            �           2604    2148922    id    DEFAULT     X   ALTER TABLE ONLY rating ALTER COLUMN id SET DEFAULT nextval('rating_id_seq'::regclass);
 :   ALTER TABLE ntrem018.rating ALTER COLUMN id DROP DEFAULT;
       ntrem018       ntrem018    false    159    148            �           2604    2121666    itemid    DEFAULT     h   ALTER TABLE ONLY ratingitem ALTER COLUMN itemid SET DEFAULT nextval('ratingitem_itemid_seq'::regclass);
 B   ALTER TABLE ntrem018.ratingitem ALTER COLUMN itemid DROP DEFAULT;
       ntrem018       ntrem018    false    156    157    157            �           2604    2066937    id    DEFAULT     `   ALTER TABLE ONLY restaurant ALTER COLUMN id SET DEFAULT nextval('restaurant_id_seq'::regclass);
 >   ALTER TABLE ntrem018.restaurant ALTER COLUMN id DROP DEFAULT;
       ntrem018       ntrem018    false    151    147            �           2604    2101683    id    DEFAULT     V   ALTER TABLE ONLY times ALTER COLUMN id SET DEFAULT nextval('times_id_seq'::regclass);
 9   ALTER TABLE ntrem018.times ALTER COLUMN id DROP DEFAULT;
       ntrem018       ntrem018    false    155    154    155            B          0    2037746    location 
   TABLE DATA               o   COPY location (fodate, pnumber, saddress, hopen, hclose, id, restid, coordinates, userid, manager) FROM stdin;
    ntrem018       ntrem018    false    150   KH       [           0    0    location_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('location_id_seq', 56, true);
            ntrem018       ntrem018    false    153            A          0    2037733    menuitem 
   TABLE DATA               Y   COPY menuitem (name, type, category, description, price, id, restid, userid) FROM stdin;
    ntrem018       ntrem018    false    149   hM       \           0    0    menuitem_id_seq    SEQUENCE SET     7   SELECT pg_catalog.setval('menuitem_id_seq', 73, true);
            ntrem018       ntrem018    false    152            >          0    2037705    rater 
   TABLE DATA               L   COPY rater (email, name, jdate, type, reputation, userid, pass) FROM stdin;
    ntrem018       ntrem018    false    146   �V       ]           0    0    rater_userid_seq    SEQUENCE SET     8   SELECT pg_catalog.setval('rater_userid_seq', 16, true);
            ntrem018       ntrem018    false    158            @          0    2037715    rating 
   TABLE DATA               `   COPY rating (date, price, food, mood, staff, comments, raterid, restid, userid, id) FROM stdin;
    ntrem018       ntrem018    false    148   BX       ^           0    0    rating_id_seq    SEQUENCE SET     6   SELECT pg_catalog.setval('rating_id_seq', 186, true);
            ntrem018       ntrem018    false    159            I          0    2121663 
   ratingitem 
   TABLE DATA               Z   COPY ratingitem (userid, date, itemid, comment, rating, menuitemid, ratingid) FROM stdin;
    ntrem018       ntrem018    false    157   Xa       _           0    0    ratingitem_itemid_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('ratingitem_itemid_seq', 1, false);
            ntrem018       ntrem018    false    156            ?          0    2037710 
   restaurant 
   TABLE DATA               2   COPY restaurant (name, type, url, id) FROM stdin;
    ntrem018       ntrem018    false    147   -b       `           0    0    restaurant_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('restaurant_id_seq', 81, true);
            ntrem018       ntrem018    false    151            G          0    2101680    times 
   TABLE DATA               9   COPY times (id, open, close, restid, "time") FROM stdin;
    ntrem018       ntrem018    false    155   'e       a           0    0    times_id_seq    SEQUENCE SET     5   SELECT pg_catalog.setval('times_id_seq', 352, true);
            ntrem018       ntrem018    false    154            =          0    1615331    distributors 
   TABLE DATA                  COPY distributors  FROM stdin;
    public       ntrem018    false    145   6j       �           2606    2087047    location_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY location
    ADD CONSTRAINT location_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY ntrem018.location DROP CONSTRAINT location_pkey;
       ntrem018         ntrem018    false    150    150            �           2606    2084577    menuitem_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY menuitem
    ADD CONSTRAINT menuitem_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY ntrem018.menuitem DROP CONSTRAINT menuitem_pkey;
       ntrem018         ntrem018    false    149    149            �           2606    2139456    primaryrating 
   CONSTRAINT     ]   ALTER TABLE ONLY rating
    ADD CONSTRAINT primaryrating PRIMARY KEY (userid, date, restid);
 @   ALTER TABLE ONLY ntrem018.rating DROP CONSTRAINT primaryrating;
       ntrem018         ntrem018    false    148    148    148    148            �           2606    2147954 
   rater_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY rater
    ADD CONSTRAINT rater_pkey PRIMARY KEY (name, userid);
 <   ALTER TABLE ONLY ntrem018.rater DROP CONSTRAINT rater_pkey;
       ntrem018         ntrem018    false    146    146    146            �           2606    2121671    ratingitem_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY ratingitem
    ADD CONSTRAINT ratingitem_pkey PRIMARY KEY (userid, date, itemid);
 F   ALTER TABLE ONLY ntrem018.ratingitem DROP CONSTRAINT ratingitem_pkey;
       ntrem018         ntrem018    false    157    157    157    157            �           2606    2066939    restaurant_id_key 
   CONSTRAINT     N   ALTER TABLE ONLY restaurant
    ADD CONSTRAINT restaurant_id_key UNIQUE (id);
 H   ALTER TABLE ONLY ntrem018.restaurant DROP CONSTRAINT restaurant_id_key;
       ntrem018         ntrem018    false    147    147            �           2606    2079326    restaurant_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY restaurant
    ADD CONSTRAINT restaurant_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY ntrem018.restaurant DROP CONSTRAINT restaurant_pkey;
       ntrem018         ntrem018    false    147    147            �           2606    2101685 
   times_pkey 
   CONSTRAINT     G   ALTER TABLE ONLY times
    ADD CONSTRAINT times_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY ntrem018.times DROP CONSTRAINT times_pkey;
       ntrem018         ntrem018    false    155    155            �           2606    2194094    foreign_to_menu_item    FK CONSTRAINT     r   ALTER TABLE ONLY ratingitem
    ADD CONSTRAINT foreign_to_menu_item FOREIGN KEY (itemid) REFERENCES menuitem(id);
 K   ALTER TABLE ONLY ntrem018.ratingitem DROP CONSTRAINT foreign_to_menu_item;
       ntrem018       ntrem018    false    149    1755    157            �           2606    2087055    location_restid_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY location
    ADD CONSTRAINT location_restid_fkey FOREIGN KEY (restid) REFERENCES restaurant(id) ON DELETE CASCADE;
 I   ALTER TABLE ONLY ntrem018.location DROP CONSTRAINT location_restid_fkey;
       ntrem018       ntrem018    false    150    147    1751            �           2606    2152578    menuitem_restid_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY menuitem
    ADD CONSTRAINT menuitem_restid_fkey FOREIGN KEY (restid) REFERENCES location(id) ON DELETE CASCADE;
 I   ALTER TABLE ONLY ntrem018.menuitem DROP CONSTRAINT menuitem_restid_fkey;
       ntrem018       ntrem018    false    150    1757    149            �           2606    2152573    rating_restid_fkey    FK CONSTRAINT     ~   ALTER TABLE ONLY rating
    ADD CONSTRAINT rating_restid_fkey FOREIGN KEY (restid) REFERENCES location(id) ON DELETE CASCADE;
 E   ALTER TABLE ONLY ntrem018.rating DROP CONSTRAINT rating_restid_fkey;
       ntrem018       ntrem018    false    148    1757    150            �           2606    2152583    times_restid_fkey    FK CONSTRAINT     |   ALTER TABLE ONLY times
    ADD CONSTRAINT times_restid_fkey FOREIGN KEY (restid) REFERENCES location(id) ON DELETE CASCADE;
 C   ALTER TABLE ONLY ntrem018.times DROP CONSTRAINT times_restid_fkey;
       ntrem018       ntrem018    false    155    150    1757            B     x��W�n�F<��bNy ����y���D��P�B��6a�4f�r6��ȏ�I�p�^j�"���jIP�,�a?�~�R�B�������ė���Ky�o��ky�ş��^�?h�L� �ia��x)�"l�9��+�J ʘ�y癴h���l���G���)�u�-����� �j��A�uW5|Q�w!&��F��B�L�{���uS���Ψԇ�ڣ�uY�`H*�Lx|��f��a��	�	�e���heS�9Sx�	�M��U���)�����-����	=�Q9?u�-������
�*��&n�{��!��!��"4]����\s�� i���h��6�2��/6[j�}6�P%hd��6�}3Z��{����Y�	��!b{������*��*
!�b��m��t��~ȼ��L��H�WhL/:3|�]���z�L46a���ݬº#>��:-�uB+�vЂ��U�V���pP8�	��')�'y:&�.;/0�E�j�o�T9E9�LK���	k~ז�>���#�>���d�0Ӆ��� ��U�_�����9�$��D������KR`8\����Z"f��cO��ap��m搰 ;3�� �e��5���.ax��qQή��0�mq�t%#���P9o������1�i��'��?�M�x2�����Z��`���Z�BO+Y��:Ѕ����"��C�]Q�{���qE-�C��0�Ԟ�e ���DA�����W�����$d"$�$�������!�4�v�P^(��C~����iڃ����*�X	��`��2�ֹq'�14U�s}᭧���Y�}�Z0�)>p"�IW�e,?ͺ�/, ��R�o��,E����hF��.�-�q�)h�vy��ck<Rw\,|�#N]R��0j��=�e�T=�E�e?��� ,�����w���b�\�g<)�����U�w�c~@9O�Y=�u8�	��'\��GDh�/���pT����Y���岗@��7۶9���P�2W�}���o�s�lVm����ed�mOD�oX���٦���qY�t9�э���f`�%(��RN�Zͪ�(%��Mza��(!�X2�5�o�p@\�=���O�bD$'#���n�`�e3S��E���MY�Y0L���}ʓ2�veѾ�/��|a��,��Pb*��>]E}@O'���oC7w9;�j��K*Ɂ~,�5e�Oq�D:�4QFVп�����>��\�Z�Bi�ݴtkސa>�aJ�;m&)^r{�o"m3�������%������������h��      A   z	  x��X�r�8}������ţ��y�d;�ƶ������DAF$�@{��޿�� (Ӳ��d��.���>�ͱ�N�"�h��.�B:�,M���Y�����&6�ZzRnK{���a�P։x�4�yW�I���/"�����L��m��gB��}�e�(:�E�a�9Y�U��{��X�!^����7dS�5�se.�J�ȿ�S��]��v'�G�!�<ћ����Q�Ȇ�i.�:����P7:�F����9��{�u�Q�d��4����9V�N�|����;3*��pR쪓���VY�_����3���H��x
v���c�7p��V~�{Q��m��i)�	�$�Z�31"_�/6]���g�u�#/���Dg+��t����Zm�a���F *tZ駔Cf���;gTg+�����];Ҹ��>�������_�J�hi�nh�X��..��{̍5���c�ʹNK����9l��]48�]��(���i�۵^�*�QQ��"o�'�Kș�����}�<��!5o�����E��-�Q��d��]��5���������w���M�'[��EC�����vk��,��m�6�֊R�,�lui�G���Og��&��p?B��ю����M��"�� �=Ňطȯg����땧� 2�VOG�g�`# o^�L�&X��eW��6��[�t0
����-M�Ⱦ\��#��U1T��ϙ�p�N�f�vG�z�c�r�:Ӊ���
�̀���g����� ��o���8��4�[.y��/��upJ��u{|��J/�^�[A7FE�*�?�7���Y?��sQqҷ��&[kF4Uw~*��+b�*�� �{#���2�[��NI�:�1{�e�p�V2QyH�ɂQ��H�;�P:��t���S�ʹ�i�l8��!p��4�}U�L|ם��i���en�'!u6ZdgUsf�-I[0wh�U�Uհ�rH�2��0���icX�L�#�����+��cΩ�)'�ڎt�
��
D��[��
��"�x+�Г����Pb���
���u6�(����D��
�RY1,���k���/lpŴ�E��-u� ���1* 剚S7-�J��v���x?���Y�f'�4�l���Eؼ�=8����m�3ݕ�b�߰+K�pM�����������f�!W*M_˨�@��t��:`�^�e��\B �T���}���J���
���B�.�n�X��@M8�VG�R�P�����:M�<�@<5T�Pb��+$m|�(�D���Q�"�e\��N���4]���^�ij_P�`�u{`k<����^'CU9HN$:���kS�S$$�ɴJ6(j÷��KB� ��T R���BU�9)����Q��L��,�q�oɚHi$�AU�_矮��}P9� 9L�0F�_v����4�^��]���]/Ю�̿�.r>�Lfb-!����DJ
�9\`e�c*�W�z��Zi��bo`z���n~���V���������2}���o��R�2�9�}@ʠ�ocf �f�D���e��2BY�P� �c@�Gųo��nC��.p�+Ȟߎ�ww���Sˣc�?Kp➖�EQfK'V@�e�{p� Md'X[ ��L6��S
O-������by}E����.��r���|�~�n�3�2��N"ԀUUiaP��(\A��ؐ�>9Zu����C�DU�27���g�>�Nh1�:;6},v���"�e2����O$�A�c�:��c�;nW���֭��!��c��B�I���E�q� ��OL��ɹ��2�|�T�Eʖ�C�;'F�<�f� ��8�hn2_�`�`��H������pA/n�����w�\s��`k%���/��4���%�0�A*����H��q�a_Ų�����h��W��#��C%t#�)w�T��Y�8��ŏA�t�9(`<���X���:vA��(�o5ǡN?�S��I���|U���U��#HV^� �J<➅{Vhc�~�cm��������'�+�N���B���r��;|'P5dt
(Ʊ)�I�����#r��� ��&�QXP!r��K�=s����+�Z����"5��w��J�D�3��5��q1E�	nHF���W���܏Y(O��g��Ů���_xT��9��RfZY�d�`o��8����a� ��BW��M��Q��?�$z|�j��Z����;V��h��9 ���\W8a�ZX���9� kÊa� K�zZ�{gh/)Zj	��P�?T慐������m�3�����Rc��E��|{/��h0��|��1��g��x��vpQ��3o�G3/+��_DlĴ1�Ch�eʬu��=�&���1�Uc���)����5b�^`[�jZ}�;�P�����iR��B��~vrr��Ӽ�      >   @  x�]�O��0���(I������Rh/��B/Q�&��,�P��kWM�ߛ�2����:|7B餂���7��1M㔒Ǎ�e��4�.V+q�`~��|3��a9�m���nJ-67U��b�s'b)a(*���G(��l"	G��T�m|v�L9����'ٮp�0�3�^Z<5廃c�[$c��j��27�ht�ϧj7i�8dn8.�g%��Z��V���p��?�!P��3)΍҃�1U�Ll^E����������/h�6a��nv?_�9�U#��0ׂ#�����ִq�+��l/�8	�+�`��G�+�e�$��?�Λ      @   	  x��Y�n�F}�|E�1�c�lR���el/FccdĘA^�R�$D������TUo�,v� ��S�u9ui&������0
� ��m�U-��.?�,?����}d
��S4	c�������X�j��@`4ǿ��Ȑ�q���A���dT՜\�V�Rj>9NP<�K�����yӢδx7客ӧ��p���%/&�x>�e=�*�:�M^e��ce�>TBlī1ĥ�Z.Oۭ����>T��I�܋@�BI���q[��D��F����Ῡ�ưʘ#gVB`: jE���r!^N�.űP�g��D~��W�Tg��hg�!Qk���"��I�^Wj��W�B�~��� ��xE���l[�uQ��9Pah&�Оlͮ��_^���9P�Ǐ�Iw�h*'���(�vX�[S���h��Ÿ!ʴ�hX�:h�)O��p��=Fē�j�r�ǳ�V#��� ��i3|��"���E�9J�nBё����O�:%���'��ϟ�C��C _�/�r�?�A�GuBS� �L(�Ϣ�����joL��� g���֖6��CGC�o����.�unNWEu.2�
�����r ��p�>���[nO��)���<l���}I?��,�xT�7�1ӥ���P�:�������l*�@Ԉx/��=�0ø���2e�W���<�NUf�1g������y��	%��Sü��phϩ��6m��# ̃ђf�ٙ�5�A�E/���ʈ����P�o��+��gS��y͍��D�2����Z�u�e��bL'c��9��b���)mƻĝk�g����%&�}���4���Y��i/���+Pј%��������.)������۷��/7�[���G]n��.��C�޵��թ=#EQo�ăj��7�3��a{����kli�Ԟ��;sC�pK� ��_R0� ��-�7jS��6�,�I���jk�M�i�C���XRO��R�w�� D/�W��6��H�����X�`�;m>�-�����R��O$⼹��b�%c��(�.�x���qsN���	j��f�����ؙ{��J�Z���%0�q�%`).[�.>���1�l�Z��Rkj�wZu������=,'��X@�C嶇|7'�>hax����ë�FŘ�ttS~V�7�h����RԺ͞2��JB.?�Z�/����m���	��S?�Q�NW����}]�Ǧ`Ah�
�Iâ�I���ӔH�~�`K��^ٴ( �d��B[G��_��C�K-]��y8f�Uf֦P�W�ɫ
*�-�%,��ȝ���uK`RaC�|�[���w��ͺ�6Ǩ`��V\(ǶP �vmY7D��\�(����x
l>�Z唫���������i�j�������ß7+q�԰�Ψ��{�.'���~	k�-��ū��0DA'��zu��&7�d`���� $�l�:��<�ن���k5b���hhE(����w-���.�	ϙ����z��qC{�]�ڍ���#��f��G��qoi֙8����p�#D_��U,J-h��W�G�UZ2��pL�-���'Xz[n�D4���1W��� t��,�����^���	��?Vd{-&�Z�] �`d�)�g���I!�fI��J����> ��A�$���˼؉UFC��e<z甿�XX��ھ�PoŢ�0�;X/���2�w��(��Z���_!=u{35RU�́���ͬ����*�y�Ɯw�5.��&�b�L��³9�O8\��:o�o����-�Q�7%h�QU{;k&���E��^��aW�-EC7-4<�X/����\o�%��o}�e�5Ν����IH���Ľ���Wb�}�6V���L�)�&n�����]�jI@*m��S��΂g{M�N�nv�urU������'s�	9GG�>Dz^D,GR޼Z���@c����N"C���Z�Z!�4&���5�}���&y�f���ׄ ��Yn;�Ҕ<�I6�z�F��A�'![6������_��I�O�ډ=/"{�v�ێ(X���xd3�c����B�=������z�d��M.�W���Z	/�(�Y�������-��x�7mX�����Ý�g'�ux9G=vh��s��n�`�~hUl��]���C�b�1D{���ȑn��Е
x�+��ic������%2
y�~�jӴ��ޛ�����H�-6W�
>����L^�F�-$鯞�9m"��������9��TD�{*�<�_�@�#%�3\�������?↵�      I   �   x�u�K� ���)�����mcӝ��4�XR"�b��۸ "����3��3i��H@*շ�d��BS�CO"�66Y�h߉������(��f����o�i�DLQT�V�2��2�Nq�Y��st�y��F1B�m4V���D|�(���(�Qķ�3��/�X��gd.K�3!�b!��.d�c�䞯91�~Oɂ~      ?   �  x��UMs�0<K�B�$��Bz'�4�$3���˳-l�Fb$
��?�O�I��M�>0��o�z~��Bk6M@��j�n��J'������=:�<ˀ=˵ r�,�.,�v���t�ZuLW%��ysϣӄ���'��8|�Mx쀋
��Kzg(t���!���8g�D-�V��v��}P҂�c�|��D冓a�c�k�w��Ʊ���_]#���D�)�dƲ�R;a~������
���UKk���.}L�D�1r}9��#2��pmMc��Ň{Q{|�	+�

P�`�;�OZȍb?r&l��XK�Yn�<i>҂�([��_5Ǚ\ҁ����h��ܐ����lp���&}�m�_-�T���Ȝ��y]n�~�KŹM�e�)�C�!9��L�\�o�m�Ǐx��Q�\El��D���+�{�o�� �ێ`�d�O}�"8�y��͸&wCA�JB�Gt��0eA�v�]Q���IP���/j&�V���[�C�}��t�-�`�!�%}��,0&c�9Ѹ�t�6�t0�< ��@���B��Ƀ����[p���PV�����&3���Z�ۋl�A��Ǆ�j�ْ��uT�R�{t�U.#�{a�3�UŭF��\4��S\��euX�~��tai��� G�Qn�W�$��AAU�vrM�T�;QҰ!�\��3�9�7;�ڲ��6�?�䪺59O�?_f�
�tFʗ5�O	K�K�g���� 1p�'���^�_J�?��>      G   �  x�m�M�7��է�"�_�*��bb���׷��U5�[5P�)}z��R��?����r�OR���z�}�������Ϗ
��������������?��{p_���H=���GA�QB���`$)�Q�GE���$*����u�������ۂ����	IF����IJ(� ��p7eee_-H��%�(]�S9�1���DNE�jE��W�G�kw���t���H1�u*�?�Q��b��R��1T6u�<��Ҍ�U�(u�<�u*v�:R�z��,S���L���M�7�z3���X����Fmv�ҡzw$)<�@Z��:��Q
�������[$�׷C\�W}��\Q�^P����e�����X����'�� ;˹�*�V�q�P�s4?�{� ͕���.u[�K눘��3M��DlFݐ���z�����7h(A	�P�2�62~W�M>��z�<���ݟ����[Hb�
4֩�汕V�;7��g���ll(�,p=J03�צ)(��!�ە�O�ͦ�Yl���b�����ǘ=�Q�=Z�Q���<�G[�c�)J��=��g74S$S������z6��'�s�v�)7w�yt�VE�X�,t=���*�'RR�b���ng5��i�m&�Υ +���m.��쓅���\��r_�5 ]�Z��:�̞�9���!NH��܍y��Q�;e������Җ�ڕ�1`��m�lnу[EQ��H�{:��${%���� ���eR[P��3N����+�^V�df�$g�0JW���J0�@	o���.n���$�'{����T�u� ��EI�.j0J�EI�.H�Ą��+�A%�:��D^i��9�}�z�lH��2;�|���͙���4�\H��
Ж<�ŏ�-��?������N�|x
�l��$ˍِd�ώ$3j���>Ck!�,I�l�`��Q@b{s��[��n�ds~"ɝ_I��!�%�k�����R"�W�J�畷R"mV�J��Yy+%�Z�	�VvC(����R���R���R���R��`� 7��@
p�_� 78����x���Se7�;�Pv��e7��4B��[e7�/}B���Pv��Fٍ�ٌ��/5��
�4�ى�l�U�샟T�l��*��~w�&̠�̠�̠���O${�w.��A$�����J�S��N-����P�T̠���ل:�Fv���Yj����Xj�����و�ws�ى�f٭�Do8��)�I�1��F�B�)H2�p��m�������]��      =      x������ � �     
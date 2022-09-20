<?php
  if ( ! defined('BASEPATH')) exit ('No direct script acces allowed');

  class VmsqlModel extends CI_Model
  {
      public function getToken(){
          $auth=$this->input->get_request_header("authorization",true);
          $exploded = explode(' ',$auth);
          if(count($exploded)<2){
              return ;
          }
          return $exploded[1];
      }

  public function testrepay($lnr)  {
  $req=null;
  try {
      $req=""
          . "select s.test from\r\n"
          . "	(\r\n"
          . "		select \r\n"
          . "		(\r\n"
          . "		case\r\n"
          . "			when (select count(*) from memrepay where lnr='".$lnr."') =0 then 0 \r\n"
          . "			else 1 \r\n"
          . "		end\r\n"
          . "		)test\r\n"
          . "\r\n"
          . "	)s	"
          . "\r\n";
  return $req;
  }catch(Exception $ex) {
    throw $ex;
}
	}
	public function impaye($lnr,$date)  {
    $req=null;
		try {

            $req=""
                . "select s.diff from \r\n"
                . "(\r\n"
                . "select (SELECT DATEDIFF(day,        r.dday , '".$date."') diff) diff\r\n"
                . "from \r\n"
                . "(\r\n"
                . "	select max(dday) dday from memdues where lnr ='".$lnr."' and dday<='".$date."' group by lnr \r\n"
                . ")r\r\n"
                . "	\r\n"
                . ")s"
                . "\r\n";
			return $req;
		}catch(Exception $ex) {
        throw $ex;
    }
	}
	public function impaye2($lnr,$date)  {
    $req=null;
		try {

            $req=""
                . "select s.diff from \r\n"
                . "(\r\n"
                . "select (SELECT DATEDIFF(day,        r.dday , '".$date."') diff) diff\r\n"
                . "from \r\n"
                . "(\r\n"
                . "	select min(dday) dday from memdues where lnr ='".$lnr."'  group by lnr\r\n"
                . ")r\r\n"
                . "	\r\n"
                . ")s"
                . "\r\n";
			return $req;
		}catch(Exception $ex) {
        throw $ex;
    }
	}

	public function benefic($cluscode)  {
    $req=null;
		try {
		    $req= "select s.nombre from\r\n"
                . "	(\r\n"
                . "		select count(cluscode) nombre from Membership where cluscode=".$cluscode." \r\n"
                . "	)s"
                . "\r\n";
            return $req;
        }catch(Exception $ex) {
        throw $ex;
    }
	}



	public function lrb()  {
$req=null;
		try {$req=""
                . " select (0) retardbilan union all\r\n"
                . " select (1) retardbilan union all\r\n"
                . " select (31) retardbilan union all\r\n"
                . " select (61) retardbilan union all\r\n"
                . " select (91) retardbilan union all\r\n"
                . " select (181) retardbilan". "\r\n";
            return $req;
        }catch(Exception $ex) {
    throw $ex;
}
	}

	public function parconsodetaille($d)  {
    $req=null;
		try {

            $req=""
                . "	select par5.* ,\r\n"
                . "		(\r\n"
                . "		case\r\n"
                . "			when par5.retard4<=0 then 0\r\n"
                . "			when 1<=par5.retard4 and par5.retard4 <=30 then 1 \r\n"
                . "			when 31<=par5.retard4 and par5.retard4 <=60 then 31 \r\n"
                . "			when 61<=par5.retard4 and par5.retard4 <=90 then 61 \r\n"
                . "			when 91<=par5.retard4 and par5.retard4 <=180 then 91 \r\n"
                . "			when 180<par5.retard4 then 181\r\n"
                . "		end\r\n"
                . "		) retardbilan\r\n"
                . "	from \r\n"
                . "	(\r\n"
                . "		select par4.* ,\r\n"
                . "			(\r\n"
                . "			case\r\n"
                . "				when par4.retard3<0 or par4.retard3 is null\r\n"
                . "				then 0\r\n"
                . "			\r\n"
                . "				else par4.retard3\r\n"
                . "			end\r\n"
                . "			) retard4\r\n"
                . "		from (\r\n"
                . "			select par3.* ,\r\n"
                . "				(\r\n"
                . "				case\r\n"
                . "					when par3.retard2<0 or par3.retard2 is null \r\n"
                . "					then 0\r\n"
                . "					when par3.datemaxmemrepay='9000-01-01 00:00:00.000' and (select (".$this->testrepay("par3.lnr").")testrepay)=0 \r\n"
                . "					then (select (".$this->impaye2("par3.lnr", $d).")impaye2) \r\n"
                . "			\r\n"
                . "					else par3.retard2\r\n"
                . "				end\r\n"
                . "				) retard3\r\n"
                . "			from \r\n"
                . "			(\r\n"
                . "				select * ,\r\n"
                . "					(\r\n"
                . "					case\r\n"
                . "						when par2.datemaxmemrepay='9000-01-01 00:00:00.000' AND par2.memrepaysolde=0 and par2.reste=par2.ldisbsolde and par2.portefeuille=par2.ldisbsolde\r\n"
                . "						then ( select (".$this->impaye("par2.lnr", $d).")impaye ) \r\n"
                . "						else par2.retard1\r\n"
                . "					end\r\n"
                . "					) retard2\r\n"
                . "				from \r\n"
                . "				(	\r\n"
                . "					select * ,\r\n"
                . "						(\r\n"
                . "						case\r\n"
                . "							when par1.retard<=0 or par1.retard is null then  0\r\n"
                . "							when par1.retard>0 then par1.retard\r\n"
                . "			\r\n"
                . "						end\r\n"
                . "						) retard1\r\n"
                . "					from \r\n"
                . "					(\r\n"
                . "		\r\n"
                . "				select *, (\r\n"
                . "\r\n"
                . "						select \r\n"
                . "									(\r\n"
                . "										case\r\n"
                . "		\r\n"
                . "											when \r\n"
                . "											(\r\n"
                . "												select count(*) from \r\n"
                . "														(\r\n"
                . "														select top 1 lnr,datedays daysdate, jourretard retard from \r\n"
                . "														(\r\n"
                . "														select r.lnr, r.dday datedays, (SELECT DATEDIFF(day,         r.dday ,'".$d."' ) ) jourretard, r.totalpaye   from \r\n"
                . "														(\r\n"
                . "															select  memdues.* , (mprinc+mint+mpen)totalpaye, sum(mprinc+mint+mpen) over (order by dday) cumuler \r\n"
                . "															from memdues where lnr=par.lnr\r\n"
                . "														)r where r.cumuler\r\n"
                . "														>\r\n"
                . "														(select sum(mprinc)+sum(mint)+sum(mpen) solderepay  \r\n"
                . "														from memrepay where lnr=par.lnr and  pday<='".$d."')\r\n"
                . "\r\n"
                . "													)r\r\n"
                . "												)a \r\n"
                . "											) = 0 \r\n"
                . "											then \r\n"
                . "											(	\r\n"
                . "														select top 1 (SELECT DATEDIFF(day,         r.dday ,'".$d."' ) ) jourretard  from \r\n"
                . "												(\r\n"
                . "													select  memdues.* , (mprinc+mint+mpen)totalpaye, sum(mprinc+mint+mpen) over (order by dday) cumuler \r\n"
                . "															from memdues where lnr=par.lnr\r\n"
                . "												)r \r\n"
                . "											)\r\n"
                . "\r\n"
                . "											else\r\n"
                . "											(\r\n"
                . "												select top 1 jourretard retard from \r\n"
                . "														(\r\n"
                . "														select r.lnr, r.dday datedays, (SELECT DATEDIFF(day,         r.dday ,'".$d."' ) ) jourretard, r.totalpaye   from \r\n"
                . "														(\r\n"
                . "															select  memdues.* , (mprinc+mint+mpen)totalpaye, sum(mprinc+mint+mpen) over (order by dday) cumuler \r\n"
                . "															from memdues where lnr=par.lnr\r\n"
                . "														)r where r.cumuler\r\n"
                . "														>\r\n"
                . "														(select sum(mprinc)+sum(mint)+sum(mpen) solderepay  \r\n"
                . "														from memrepay where lnr=par.lnr and  pday<='".$d."')\r\n"
                . "\r\n"
                . "													)r\r\n"
                . "											)\r\n"
                . "										end\r\n"
                . "									) retard\r\n"
                . "						) retard \r\n"
                . "\r\n"
                . "\r\n"
                . "						from \r\n"
                . "						(\r\n"
                . "								select s.*, lap.officier1,lap.officier2,lap.officier3 \r\n"
                . "								,loan.loanclcode,loan.loancluscode,loan.loantuserid,loan.loanappby, loan.loannrin, loan.loaninstype\r\n"
                . "								,loan.loanlamount,loan.loantint,loan.loanintamount,loan.loanuid,loan.loanprodid,\r\n"
                . "									products.productsname,\r\n"
                . "										(case when loan.loanclcode !='' then pers.persclname else cluster.name end ) name ,\r\n"
                . "										(case when loan.loanclcode !=''   then pers.persclsurname  else cluster.physadd end )persclsurname,\r\n"
                . "										(case when loan.loanclcode !=''  then  pers.perssex else  'groupeio'  end )perssex\r\n"
                . "\r\n"
                . "							from \r\n"
                . "								(\r\n"
                . "										select r.lnr,\r\n"
                . "										max(r.memdusolde)memdusolde , max(r.dateldisb)dateldisb, max(r.memrepaysolde)memrepaysolde\r\n"
                . "										,max(r.reste)reste,max(r.ldisbsolde)ldisbsolde,max(r.portefeuille)portefeuille,\r\n"
                . "										max(r.datemaxmemdues)datemaxmemdues , max(r.datemaxmemrepay)datemaxmemrepay from\r\n"
                . "								(\r\n"
                . "								(\r\n"
                . "										select s.lnr,\r\n"
                . "										max(s.memdusolde)memdusolde , max(s.dateldisb)dateldisb, max(s.memrepaysolde)memrepaysolde\r\n"
                . "										,max(s.reste)reste,max(s.ldisbsolde)ldisbsolde,max(s.portefeuille)portefeuille,\r\n"
                . "										max(s.datemaxmemdues)datemaxmemdues , max(s.datemaxmemrepay)datemaxmemrepay from\r\n"
                . "									(\r\n"
                . "										select l.lnr lnr, d.memdusolde , l.dateldisb,\r\n"
                . "										r.memrepaysolde , (l.ldisbsolde-r.memrepaysolde ) reste ,\r\n"
                . "										l.ldisbsolde,(l.ldisbsolde-r.memrepaysolde)portefeuille ,\r\n"
                . "										d.datemaxmemdues , r.datemaxmemrepay  from\r\n"
                . "\r\n"
                . "										(select lnr, sum(ldamount) ldisbsolde, max(ldday) dateldisb from ldisb group by lnr)l\r\n"
                . "										left join\r\n"
                . "										(select lnr, sum(mprinc) memrepaysolde  , max(pday) datemaxmemrepay \r\n"
                . "										from memrepay where  pday<='".$d."'  group by lnr)r\r\n"
                . "										on l.lnr=r.lnr \r\n"
                . "										left join\r\n"
                . "										(select lnr, sum(mprinc) memdusolde , max(dday) datemaxmemdues \r\n"
                . "										 from memdues where  dday<='".$d."'  group by lnr ) d\r\n"
                . "										 on d.lnr=l.lnr\r\n"
                . "										 where (l.ldisbsolde-r.memrepaysolde )<0 and l.dateldisb>='2015-01-01 00:00:00'  \r\n"
                . "										 and (d.memdusolde-r.memrepaysolde)>0\r\n"
                . "								)s\r\n"
                . "								group by s.lnr\r\n"
                . "\r\n"
                . "								)\r\n"
                . "								Union \r\n"
                . "								(\r\n"
                . "									select l.lnr lnr, d.memdusolde , l.dateldisb,\r\n"
                . "									r.memrepaysolde , (d.memdusolde-r.memrepaysolde) reste ,\r\n"
                . "									l.ldisbsolde,(l.ldisbsolde-r.memrepaysolde ) portefeuille ,\r\n"
                . "									d.datemaxmemdues , r.datemaxmemrepay  from\r\n"
                . "									(select lnr, sum(ldamount) ldisbsolde, max(ldday) dateldisb from ldisb group by lnr )l\r\n"
                . "										left join\r\n"
                . "										(select lnr, sum(mprinc) memrepaysolde  , max(pday) datemaxmemrepay \r\n"
                . "										from memrepay where  pday<='".$d."' group by lnr)r\r\n"
                . "										on l.lnr=r.lnr \r\n"
                . "										left join\r\n"
                . "										(select lnr, sum(mprinc) memdusolde , max(dday) datemaxmemdues \r\n"
                . "										 from memdues where  dday<='".$d."'  group by lnr ) d\r\n"
                . "										 on d.lnr=l.lnr\r\n"
                . "										 where (l.ldisbsolde-r.memrepaysolde )>0 and l.dateldisb>='2015-01-01 00:00:00'  \r\n"
                . "								)\r\n"
                . "								union \r\n"
                . "								(\r\n"
                . "									select memdues.lnr lnr,\r\n"
                . "									max(memdues.mprinc) memdusolde, max(l.ldday) dateldisb, (select 0) memrepaysolde,\r\n"
                . "									sum(l.ldamount) reste,max(l.ldamount) ldisbsolde, max(l.ldamount) portefeuille,\r\n"
                . "									max(memdues.dday) datemaxmemdues, (select ('9000-01-01 00:00:00') )datemaxmemrepay\r\n"
                . "									from memdues \r\n"
                . "									join (select lnr lnr , sum(ldamount) ldamount, max(ldday) ldday from ldisb group by lnr)l \r\n"
                . "									on l.lnr= memdues.lnr\r\n"
                . "									where memdues.lnr not in (select lnr from memrepay where pday<='".$d."' )\r\n"
                . "									and '2015-01-01 00:00:00'<= l.ldday and l.ldday<='".$d."'\r\n"
                . "									group by memdues.lnr\r\n"
                . "								)\r\n"
                . "\r\n"
                . "								)r\r\n"
                . "							group by r.lnr\r\n"
                . "							)s\r\n"
                . "							left join \r\n"
                . "							(select lnr,max(Lvl1Officer)officier1, max(Lvl2Officer) officier2, max(Lvl3Officer) officier3 from Lapproval group by lnr) lap\r\n"
                . "							on lap.lnr=s.lnr\r\n"
                . "							left join \r\n"
                . "							(\r\n"
                . "								select lnr,clcode loanclcode,cluscode loancluscode,lamount loanlamount,tint loantint,intamount loanintamount,tuserid loantuserid,nrin loannrin,instype loaninstype,uid loanuid,prodid loanprodid,appby loanappby from loan\r\n"
                . "							)loan\r\n"
                . "							on loan.lnr=s.lnr\r\n"
                . "							left join \r\n"
                . "							(select clcode,max(clname) persclname,max(clsurname) persclsurname,max(sex) perssex from persons group by clcode) pers\r\n"
                . "							on pers.clcode=loan.loanclcode\r\n"
                . "							left join (select ProdID,VarValue productsname from products where varname='PRODNAME')products on loan.loanprodid=products.ProdID\r\n"
                . "	\r\n"
                . "							left join cluster on cluster.cluscode=loan.loancluscode\r\n"
                . "\r\n"
                . "						)par\r\n"
                . "					)par1\r\n"
                . "				)par2\r\n"
                . "\r\n"
                . "			)par3\r\n"
                . "		)par4\r\n"
                . "	)par5\r\n"
            ;

			return $req;
		}catch(Exception $ex) {
        throw $ex;
    }
	}
	public function parconsodetaillebenefic($d) {
    $req=""
        . "select *,"
        . "	(	\r\n"
        . "		case\r\n"
        . "			when loanclcode!='' then 1 \r\n"
        . "			else(select (".$this->benefic("loancluscode")."))   \r\n"
        . "		end\r\n"
        . "	) benefic  "
        . " from (".$this->parconsodetaille($d).")cc"
    . "\r\n"
    ;
		return $req;
	}

	public function parconsoresumer($d) {


        $req=""
        . "	select lrb.retardbilan retardbilan,ISNULL(nombre,0) nombre ,isnull(prnombre ,0)prnombre , \r\n"
        . "	ISNULL(montant,0) montant, ISNULL(prmontant,0) prmontant , ISNULL(total,0) total,\r\n"
        . "	ISNULL(date,'1800-01-01') date, ISNULL(cumuler1,0) cumuler1, ISNULL(cumuler2,0)cumuler2,\r\n"
        . "	ISNULL(prcumuler,0) prcumuler, ISNULL(agence,'conso') agence\r\n"
        . "	from \r\n"
        . "	(\r\n"
        . "		select r1.*,'".$d."' date, sum(r1.montant) over (order by r1.retardbilan) cumuler1\r\n"
        . "		, (r1.total - sum(r1.montant) over (order by r1.retardbilan asc) ) cumuler2\r\n"
        . "		,(  Cast( Round(   (  (r1.total - sum(r1.montant) over (order by r1.retardbilan) ) *100 / r1.total  )  ,2 ) as decimal(18,2))  ) prcumuler,\r\n"
        . "		('conso') agence\r\n"
        . "\r\n"
        . "		from (\r\n"
        . "		select retardbilan,count(*) nombre\r\n"
        . "		,(  Cast( Round(   (  count(*) *100.0 /(sum(count(*) ) over() )  )  ,2 ) as decimal(18,2))  ) prnombre,\r\n"
        . "\r\n"
        . "		sum(portefeuille) montant\r\n"
        . "		,(  Cast( Round(   (  sum(portefeuille)*100/(sum(sum(portefeuille) ) over() )  )  ,2 ) as decimal(18,2))  ) prmontant,\r\n"
        . "		( sum(sum(portefeuille) ) over()) total\r\n"
        . "\r\n"
        . "		from( ".$this->parconsodetaille($d)  .")p group by retardbilan\r\n"
        . "		)r1\r\n"
        . "	)r2 \r\n"
        . "	right join \r\n"
        . "	(select * from (".$this->lrb().")l )lrb on lrb.retardbilan=r2.retardbilan"
            . "\r\n";


        return $req;
	}



	public function paragencedetaille($d, $agence) {
    $req=""
        . "select * "
        ." from( ".$this->parconsodetaille($d)  .")p"
        . " where lnr like '".$agence."'+'/%' "
        . "\r\n";
		return $req;
	}

	public function paragenceresumer($date, $agence) {


		$req=""
        . "select lrb.retardbilan retardbilan,ISNULL(nombre,0) nombre ,isnull(prnombre ,0)prnombre , \r\n"
        . "	ISNULL(montant,0) montant, ISNULL(prmontant,0) prmontant , ISNULL(total,0) total,\r\n"
        . "	ISNULL(date,'1800-01-01') date, ISNULL(cumuler1,0) cumuler1, ISNULL(cumuler2,0)cumuler2,\r\n"
        . "	ISNULL(prcumuler,0) prcumuler, ISNULL(agence,'".$agence."') agence\r\n"
        . "	from \r\n"
        . "	(\r\n"
        . "		select r1.*,'".$date."' date, sum(r1.montant) over (order by r1.retardbilan) cumuler1\r\n"
        . "		, (r1.total - sum(r1.montant) over (order by r1.retardbilan asc) ) cumuler2\r\n"
        . "		,(  Cast( Round(   (  (r1.total - sum(r1.montant) over (order by r1.retardbilan) ) *100 / r1.total  )  ,2 ) as decimal(18,2))  ) prcumuler\r\n"
        . "			,('".$agence."') agence\r\n"
        . "		from (\r\n"
        . "		select retardbilan,count(*) nombre\r\n"
        . "		,(  Cast( Round(   (  count(*) *100.0 /(sum(count(*) ) over() )  )  ,2 ) as decimal(18,2))  ) prnombre,\r\n"
        . "\r\n"
        . "		sum(portefeuille) montant\r\n"
        . "		,(  Cast( Round(   (  sum(portefeuille)*100/(sum(sum(portefeuille) ) over() )  )  ,2 ) as decimal(18,2))  ) prmontant,\r\n"
        . "		( sum(sum(portefeuille) ) over()) total\r\n"
        ." from( ".$this->parconsodetaille($date)  .")p"
        . "		 where lnr like '".$agence."'+'/%' \r\n"
        . "		group by retardbilan\r\n"
        . "		)r1\r\n"
        . "	)r2 \r\n"
        . "	right join \r\n"
        . "	(select * from (".$this->lrb().")l )lrb on lrb.retardbilan=r2.retardbilan"
            . "\r\n";


		return $req;
	}

	public function paragencedetaillebenefic($d, $agence) {
    $req=""
        . "select *,"
        . "	(	\r\n"
        . "		case\r\n"
        . "			when loanclcode!='' then 1 \r\n"
        . "			else(select (".$this->benefic("loancluscode").")) \r\n"
        . "		end\r\n"
        . "	) benefic  "
        . " from (".$this->paragencedetaille($d,$agence).")cc"
        . "\r\n";
		return $req;
	}
	public function paracall($d) {
    $req=""
        . "select users.surname, users.tfunction,  users.BranchID ,r.*  from \r\n"
        . "		(\r\n"
        . "			select  loantuserid, sum(portefeuille)montant , count(portefeuille) nombre \r\n"
        ." from( ".$this->parconsodetaille($d)  .")p  "
        . "			where retardbilan!=0 group by loantuserid\r\n"
        . "		) r\r\n"
        . "		left join users on users.tuserid=r.loantuserid"
        . "\r\n";


		return $req;
	}

	public function parofficier1all($d) {
    $req=""
        . "	select users.surname, users.tfunction, users.BranchID ,r.*  from \r\n"
        . "		(\r\n"
        . "			select  officier1, sum(portefeuille)montant , count(portefeuille) nombre \r\n"
        ." from( ".$this->parconsodetaille($d)  .")p  "
        . "			where retardbilan!=0 group by officier1\r\n"
        . "		) r\r\n"
        . "		left join users on users.tuserid=r.officier1"
        . "\r\n";


		return $req;
	}

	public function parconsoresumer2($d) {
    $req=""
        . "	select titre,montant ,Cast( Round(   (montant*100/total)  ,2 ) as decimal(18,2))  pourcentage , total from \r\n"
        . "	(\r\n"
        . "		select ('Par 1J en MGA') titre, sum(montant)  montant,max(total) total \r\n"
        ." from( ".$this->parconsoresumer($d)  .")p  where retardbilan>0\r\n"
        . "	)conso\r\n"
        . "	union all\r\n"
        . "	select titre,montant , Cast( Round(   (montant*100/total)  ,2 ) as decimal(18,2)) pourcentage , total from \r\n"
        . "	(\r\n"
        . "		select ('Par 30J en MGA') titre, sum(montant)  montant,max(total) total \r\n"
        ." from( ".$this->parconsoresumer($d)  .")p  where retardbilan>30\r\n"
        . "	)conso\r\n"
        . "	union all\r\n"
        . "	select titre,montant , Cast( Round(   (montant*100/total)  ,2 ) as decimal(18,2))  pourcentage , total from \r\n"
        . "	(\r\n"
        . "		select ('Par 90J en MGA') titre, sum(montant)  montant,max(total) total \r\n"
        ." from( ".$this->parconsoresumer($d)  .")p   where retardbilan>90\r\n"
        . "	)conso"
        . "\r\n";

		return $req;
	}


//	public function ep($d ) {
//
//
//		$req=""
//				. "\r\n"
//				. "	select accnr,balance,tday,r4.prodid,clcode,cluscode,name,surname,sex,r5.varvalue productsname from \r\n"
//				. "			(\r\n"
//				. "\r\n"
//				. "			select * from \r\n"
//				. "			(\r\n"
//				. "			select accnr accnr , sum(amount) balance , max(tday) tday, max(prodid) prodid from savta \r\n"
//				. "\r\n"
//				. "			where tday<='".$date."'  and prodid=@prod\r\n"
//				. "\r\n"
//				. "			group by accnr  \r\n"
//				. "			)r1\r\n"
//				. "			 join \r\n"
//				. "			(\r\n"
//				. "				select clcode clcode,('indivio') cluscode, clname name,clsurname surname,sex sex from persons\r\n"
//				. "			)r2\r\n"
//				. "			on ( r1.accnr=r2.clcode)\r\n"
//				. "\r\n"
//				. "			union all\r\n"
//				. "\r\n"
//				. "			select * from \r\n"
//				. "			(\r\n"
//				. "			select accnr accnr , sum(amount) bal , max(tday) tday, max(prodid) prodid from savta \r\n"
//				. "\r\n"
//				. "			where tday<='".$date."'  and prodid=@prod\r\n"
//				. "\r\n"
//				. "			group by accnr  \r\n"
//				. "			)r1\r\n"
//				. "			 join \r\n"
//				. "			(\r\n"
//				. "				select ('groupeio') clcode, cluscode , name name, physadd surname , ('groupeio') sex from cluster\r\n"
//				. "			)r3\r\n"
//				. "			on r1.accnr=r3.cluscode\r\n"
//				. "			)r4  \r\n"
//				. "			join (select prodId prodId , varvalue  from products where varname='PRODNAME' AND ProdID like '%S%') r5\r\n"
//				. "			on r5.prodId=r4.prodid	";
//		return $req;
//	}

	public function ep($d, $prod) {


		$req=""
        . "	select accnr,balance,tday,r4.prodid,clcode,cluscode,name,surname,sex,r5.varvalue productsname from \r\n"
        . "			(\r\n"
        . "\r\n"
        . "			select * from \r\n"
        . "			(\r\n"
        . "			select accnr accnr , sum(amount) balance , max(tday) tday, max(prodid) prodid from savta \r\n"
        . "\r\n"
        . "			where tday<='".$d."'  and prodid='".$prod."'  \r\n"
        . "\r\n"
        . "			group by accnr  \r\n"
        . "			)r1\r\n"
        . "			 join \r\n"
        . "			(\r\n"
        . "				select clcode clcode,('indivio') cluscode, clname name,clsurname surname,sex sex from persons\r\n"
        . "			)r2\r\n"
        . "			on ( r1.accnr=r2.clcode)\r\n"
        . "\r\n"
        . "			union all\r\n"
        . "\r\n"
        . "			select * from \r\n"
        . "			(\r\n"
        . "			select accnr accnr , sum(amount) bal , max(tday) tday, max(prodid) prodid from savta \r\n"
        . "\r\n"
        . "			where tday<='".$d."'  and prodid='".$prod."'  \r\n"
        . "\r\n"
        . "			group by accnr  \r\n"
        . "			)r1\r\n"
        . "			 join \r\n"
        . "			(\r\n"
        . "				select ('groupeio') clcode, cluscode , name name, physadd surname , ('groupeio') sex from cluster\r\n"
        . "			)r3\r\n"
        . "			on r1.accnr=r3.cluscode\r\n"
        . "			)r4  \r\n"
        . "			join (select prodId prodId , varvalue  from products where varname='PRODNAME' AND ProdID like '%S%') r5\r\n"
        . "			on r5.prodId=r4.prodid	"
            . "\r\n";
		return $req;
	}

	public function ep_all($date) {


		$req=""
        . "	select accnr,balance,tday,r4.prodid,clcode,cluscode,name,surname,sex,r5.varvalue productsname from \r\n"
        . "			(\r\n"
        . "\r\n"
        . "			select * from \r\n"
        . "			(\r\n"
        . "			select accnr accnr , sum(amount) balance , max(tday) tday, max(prodid) prodid from savta \r\n"
        . "\r\n"
        . "			where tday<='".$date."'  \r\n"
        . "\r\n"
        . "			group by accnr  \r\n"
        . "			)r1\r\n"
        . "			 join \r\n"
        . "			(\r\n"
        . "				select clcode clcode,('indivio') cluscode, clname name,clsurname surname,sex sex from persons\r\n"
        . "			)r2\r\n"
        . "			on ( r1.accnr=r2.clcode)\r\n"
        . "\r\n"
        . "			union all\r\n"
        . "\r\n"
        . "			select * from \r\n"
        . "			(\r\n"
        . "			select accnr accnr , sum(amount) bal , max(tday) tday, max(prodid) prodid from savta \r\n"
        . "\r\n"
        . "			where tday<='".$date."'  \r\n"
        . "\r\n"
        . "			group by accnr  \r\n"
        . "			)r1\r\n"
        . "			 join \r\n"
        . "			(\r\n"
        . "				select ('groupeio') clcode, cluscode , name name, physadd surname , ('groupeio') sex from cluster\r\n"
        . "			)r3\r\n"
        . "			on r1.accnr=r3.cluscode\r\n"
        . "			)r4  \r\n"
        . "			join (select prodId prodId , varvalue from products where varname='PRODNAME' AND ProdID like '%S%') r5\r\n"
        . "			on r5.prodId=r4.prodid	"
            . "\r\n";

		return $req;
	}

	public function dat($date) {


		$req=""
        . "	select * from \r\n"
        . "	(\r\n"
        . "		select ISNULL( tdtrans.clientcode,'') clientcode, ISNULL(tdtrans.tday,'') tday , tdtrans.td,tdtrans.TW, (tdtrans.TD-tdtrans.tw)balance \r\n"
        . "		from \r\n"
        . "		(\r\n"
        . "			select tdtrans1.clientcode, (case when tday1>tday2 then tday1 else tday2 end)tday , ISNULL(TD,0) TD,ISNULL(TW ,0) TW\r\n"
        . "			from \r\n"
        . "			(select clientcode,max(tday) tday, sum(amount) TD, max(tday) tday1 from tdtrans where type='TD' and tday<='".$date."' group by clientcode)tdtrans1\r\n"
        . "			full join \r\n"
        . "			(select  clientcode,max(tday) tday,sum(amount) TW,  max(tday) tday2  from tdtrans where  type='TW' and tday<='".$date."' group by clientcode)tdtrans2\r\n"
        . "			on tdtrans1.clientcode=tdtrans2.clientcode\r\n"
        . "		)tdtrans\r\n"
        . "	)tdtrans2"
            . "\r\n";
    ;
		return $req;
	}


	public function credit() {
$req=""
    . "	select * from \r\n"
    . "	(\r\n"
    . "		select  ldisb.lnr lnr, max(ldisb.ldday) ldday, sum(ldisb.ldamount) ldamount, max(voucher) voucher, sum(commission) commission\r\n"
    . "		from ldisb  group by lnr\r\n"
    . "	)ldisb\r\n"
    . "	join \r\n"
    . "	(\r\n"
    . "		select lnr loanlnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby from loan where cluscode=''\r\n"
    . "	)loan \r\n"
    . "	on loan.loanlnr=ldisb.lnr\r\n"
    . "	left join \r\n"
    . "	(\r\n"
    . "		select clcode clientcode,max(clname) name, max(clsurname) surname,max(sex) sex ,max(phone) phone from persons group by clcode\r\n"
    . "	)pers\r\n"
    . "	on pers.clientcode=loan.clcode\r\n"
    . "	\r\n"
    . "	left join (select ProdID prodIdProduct, VarValue productsname from products where VarName='PRODNAME' ) prod\r\n"
    . "	on prod.prodIdProduct=loan.prodid\r\n"
    . "\r\n"
    . "	union all\r\n"
    . "\r\n"
    . "	select * from \r\n"
    . "	(\r\n"
    . "		select  ldisb.lnr lnr, max(ldisb.ldday) ldday, sum(ldisb.ldamount) ldamount, max(voucher) voucher, sum(commission) commission\r\n"
    . "		from ldisb  group by lnr\r\n"
    . "	)ldisb\r\n"
    . "	join \r\n"
    . "	(\r\n"
    . "		select lnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby from loan where clcode=''\r\n"
    . "	)loan \r\n"
    . "	on loan.lnr=ldisb.lnr\r\n"
    . "	left join \r\n"
    . "	(\r\n"
    . "		select cluscode clientcode,name name, physadd surname,('groupeio')sex,('groupeio')phone from cluster\r\n"
    . "	)clus\r\n"
    . "	on clus.clientcode=loan.cluscode\r\n"
    . "		left join (select ProdID prodIdProduct, VarValue VarValue from products where VarName='PRODNAME' ) prod\r\n"
    . "	on prod.prodIdProduct=loan.prodid\r\n"
    . "\r\n";
		return $req;
	}
	public function creditdateconso($date1, $date2) {

		$req=""
        . "	select * from \r\n"
        . "	(\r\n"
        . "		select  ldisb.lnr lnr, max(ldisb.ldday) ldday, sum(ldisb.ldamount) ldamount, max(voucher) voucher, sum(commission) commission\r\n"
        . "		from ldisb where '".$date1."'<=ldday and ldday<= '".$date2."'  group by lnr\r\n"
        . "	)ldisb\r\n"
        . "	join \r\n"
        . "	(\r\n"
        . "		select lnr loanlnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby from loan where cluscode=''\r\n"
        . "	)loan \r\n"
        . "	on loan.loanlnr=ldisb.lnr\r\n"
        . "	left join \r\n"
        . "	(\r\n"
        . "		select clcode clientcode,max(clname) name, max(clsurname) surname,max(sex) sex ,max(phone) phone from persons group by clcode\r\n"
        . "	)pers\r\n"
        . "	on pers.clientcode=loan.clcode\r\n"
        . "	\r\n"
        . "	left join (select ProdID prodIdProduct, VarValue productsname from products where VarName='PRODNAME' ) prod\r\n"
        . "	on prod.prodIdProduct=loan.prodid\r\n"
        . "\r\n"
        . "	union all\r\n"
        . "\r\n"
        . "	select * from \r\n"
        . "	(\r\n"
        . "		select  ldisb.lnr lnr, max(ldisb.ldday) ldday, sum(ldisb.ldamount) ldamount, max(voucher) voucher, sum(commission) commission\r\n"
        . "		from ldisb  where '".$date1."'<=ldday and ldday<= '".$date2."' group by lnr\r\n"
        . "	)ldisb\r\n"
        . "	join \r\n"
        . "	(\r\n"
        . "		select lnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby from loan where clcode=''\r\n"
        . "	)loan \r\n"
        . "	on loan.lnr=ldisb.lnr\r\n"
        . "	left join \r\n"
        . "	(\r\n"
        . "		select cluscode clientcode,name name, physadd surname,('groupeio')sex,('groupeio')phone from cluster\r\n"
        . "	)clus\r\n"
        . "	on clus.clientcode=loan.cluscode\r\n"
        . "		left join (select ProdID prodIdProduct, VarValue VarValue from products where VarName='PRODNAME' ) prod\r\n"
        . "	on prod.prodIdProduct=loan.prodid"
            . "\r\n";
		return $req;
	}

	public function creditdateagence($date1, $date2, $agence) {
		$req=""
        . "select * from \r\n"
        . "	(\r\n"
        . "		select  ldisb.lnr lnr, max(ldisb.ldday) ldday, sum(ldisb.ldamount) ldamount, max(voucher) voucher, sum(commission) commission\r\n"
        . "		from ldisb where '".$date1."'<=ldday and ldday<= '".$date2."' and lnr like '".$agence."'+'/%' group by lnr\r\n"
        . "	)ldisb\r\n"
        . "	join \r\n"
        . "	(\r\n"
        . "		select lnr loanlnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby from loan where cluscode=''\r\n"
        . "	)loan \r\n"
        . "	on loan.loanlnr=ldisb.lnr\r\n"
        . "	left join \r\n"
        . "	(\r\n"
        . "		select clcode clientcode,max(clname) name, max(clsurname) surname,max(sex) sex ,max(phone) phone from persons group by clcode\r\n"
        . "	)pers\r\n"
        . "	on pers.clientcode=loan.clcode\r\n"
        . "	\r\n"
        . "	left join (select ProdID prodIdProduct, VarValue productsname from products where VarName='PRODNAME' ) prod\r\n"
        . "	on prod.prodIdProduct=loan.prodid\r\n"
        . "\r\n"
        . "	union all\r\n"
        . "\r\n"
        . "	select * from \r\n"
        . "	(\r\n"
        . "		select  ldisb.lnr lnr, max(ldisb.ldday) ldday, sum(ldisb.ldamount) ldamount, max(voucher) voucher, sum(commission) commission\r\n"
        . "		from ldisb  where '".$date1."'<=ldday and ldday<= '".$date2."' and lnr like '".$agence."'+'/%'  group by lnr\r\n"
        . "	)ldisb\r\n"
        . "	join \r\n"
        . "	(\r\n"
        . "		select lnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby from loan where clcode=''\r\n"
        . "	)loan \r\n"
        . "	on loan.lnr=ldisb.lnr\r\n"
        . "	left join \r\n"
        . "	(\r\n"
        . "		select cluscode clientcode,name name, physadd surname,('groupeio')sex,('groupeio')phone from cluster\r\n"
        . "	)clus\r\n"
        . "	on clus.clientcode=loan.cluscode\r\n"
        . "		left join (select ProdID prodIdProduct, VarValue VarValue from products where VarName='PRODNAME' ) prod\r\n"
        . "	on prod.prodIdProduct=loan.prodid"
        . ""
            . "\r\n";
		return $req;
	}

	public function creditbeneficdateconso($date1, $date2) {

		$req=""
        . "select * from \r\n"
        . "(\r\n"
        . "	select *,(1) benefic  from \r\n"
        . "		(\r\n"
        . "			select  ldisb.lnr lnr, max(ldisb.ldday) ldday, sum(ldisb.ldamount) ldamount, max(voucher) voucher, sum(commission) commission\r\n"
        . "			from ldisb where '".$date1."'<=ldday and ldday<= '".$date2."'  group by lnr\r\n"
        . "		)ldisb\r\n"
        . "		join \r\n"
        . "		(\r\n"
        . "			select lnr loanlnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby from loan where cluscode=''\r\n"
        . "		)loan \r\n"
        . "		on loan.loanlnr=ldisb.lnr\r\n"
        . "		left join \r\n"
        . "		(\r\n"
        . "			select clcode clientcode,max(clname) name, max(clsurname) surname,max(sex) sex ,max(phone) phone from persons group by clcode\r\n"
        . "		)pers\r\n"
        . "		on pers.clientcode=loan.clcode\r\n"
        . "	\r\n"
        . "		left join (select ProdID prodIdProduct, VarValue productsname from products where VarName='PRODNAME' ) prod\r\n"
        . "		on prod.prodIdProduct=loan.prodid\r\n"
        . "\r\n"
        . "		union all\r\n"
        . "\r\n"
        . "		select *,\r\n"
        . "		(\r\n"
        . "			select count(cluscode) nombre from Membership where cluscode=loan.cluscode\r\n"
        . "		) benefic from \r\n"
        . "		(\r\n"
        . "			select  ldisb.lnr lnr, max(ldisb.ldday) ldday, sum(ldisb.ldamount) ldamount, max(voucher) voucher, sum(commission) commission\r\n"
        . "			from ldisb  where '".$date1."'<=ldday and ldday<= '".$date2."'  group by lnr\r\n"
        . "		)ldisb\r\n"
        . "		join \r\n"
        . "		(\r\n"
        . "			select lnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby from loan where clcode=''\r\n"
        . "		)loan \r\n"
        . "		on loan.lnr=ldisb.lnr\r\n"
        . "		left join \r\n"
        . "		(\r\n"
        . "			select cluscode clientcode,name name, physadd surname,('groupeio')sex,('groupeio')phone from cluster\r\n"
        . "		)clus\r\n"
        . "		on clus.clientcode=loan.cluscode\r\n"
        . "			left join (select ProdID prodIdProduct, VarValue VarValue from products where VarName='PRODNAME' ) prod\r\n"
        . "		on prod.prodIdProduct=loan.prodid\r\n"
        . ")ff"
            . "\r\n";
		return $req;
	}

	public function creditbeneficdateagence($date1, $date2, $agence) {
		$req=""
        . "select *,(1) benefic  from \r\n"
        . "		(\r\n"
        . "			select  ldisb.lnr lnr, max(ldisb.ldday) ldday, sum(ldisb.ldamount) ldamount, max(voucher) voucher, sum(commission) commission\r\n"
        . "			from ldisb where '".$date1."'<=ldday and ldday<= '".$date2."' and lnr like '".$agence."' +'/%'   group by lnr\r\n"
        . "		)ldisb\r\n"
        . "		join \r\n"
        . "		(\r\n"
        . "			select lnr loanlnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby from loan where cluscode=''\r\n"
        . "		)loan \r\n"
        . "		on loan.loanlnr=ldisb.lnr\r\n"
        . "		left join \r\n"
        . "		(\r\n"
        . "			select clcode clientcode,max(clname) name, max(clsurname) surname,max(sex) sex ,max(phone) phone from persons group by clcode\r\n"
        . "		)pers\r\n"
        . "		on pers.clientcode=loan.clcode\r\n"
        . "	\r\n"
        . "		left join (select ProdID prodIdProduct, VarValue productsname from products where VarName='PRODNAME' ) prod\r\n"
        . "		on prod.prodIdProduct=loan.prodid\r\n"
        . "\r\n"
        . "		union all\r\n"
        . "\r\n"
        . "		select *,\r\n"
        . "		(select (".$this->benefic("loan.cluscode").")) benefic \r\n"
        . "		from \r\n"
        . "		(\r\n"
        . "			select  ldisb.lnr lnr, max(ldisb.ldday) ldday, sum(ldisb.ldamount) ldamount, max(voucher) voucher, sum(commission) commission\r\n"
        . "			from ldisb  where '".$date1."'<=ldday and ldday<= '".$date2."' and lnr like '".$agence."' +'/%'  group by lnr\r\n"
        . "		)ldisb\r\n"
        . "		join \r\n"
        . "		(\r\n"
        . "			select lnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby from loan where clcode=''\r\n"
        . "		)loan \r\n"
        . "		on loan.lnr=ldisb.lnr\r\n"
        . "		left join \r\n"
        . "		(\r\n"
        . "			select cluscode clientcode,name name, physadd surname,('groupeio')sex,('groupeio')phone from cluster\r\n"
        . "		)clus\r\n"
        . "		on clus.clientcode=loan.cluscode\r\n"
        . "			left join (select ProdID prodIdProduct, VarValue VarValue from products where VarName='PRODNAME' ) prod\r\n"
        . "		on prod.prodIdProduct=loan.prodid"
        . ""
            . "\r\n";

		return $req;
	}

	public function clientnonapprouverdateconso($date) {


		$req=""
        . "select * from\r\n"
        . "	(\r\n"
        . "		select lnr,clientcode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby ,tstart,exp,\r\n"
        . "		name,surname,sex,phone,varvalue productsname\r\n"
        . "		from \r\n"
        . "		(\r\n"
        . "			select lnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby ,tstart,exp\r\n"
        . "			from loan where Approved!='Y' and tstart<='".$date."'  and exp>=(select getdate())\r\n"
        . "		)loan\r\n"
        . "		left join \r\n"
        . "			(\r\n"
        . "				select clcode clientcode,max(clname) name, max(clsurname) surname,max(sex) sex ,max(phone) phone from persons group by clcode\r\n"
        . "			)pers\r\n"
        . "			on pers.clientcode=loan.clcode\r\n"
        . "		left join (select ProdID prodIdProduct, VarValue VarValue from products where VarName='PRODNAME' ) prod\r\n"
        . "			on prod.prodIdProduct=loan.prodid\r\n"
        . "		where lnr not in (select lnr from ldisb) and cluscode=''\r\n"
        . "		union all\r\n"
        . "		select lnr,clientcode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby ,tstart,exp,\r\n"
        . "		name,surname,sex,phone,varvalue productsname from \r\n"
        . "		(\r\n"
        . "			select lnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby ,tstart,exp\r\n"
        . "			from loan where Approved!='Y' and tstart<='".$date."'  and exp>=(select getdate())\r\n"
        . "		)loan\r\n"
        . "		left join \r\n"
        . "			(\r\n"
        . "				select cluscode clientcode,name name, physadd surname,('groupeio')sex,('groupeio')phone from cluster\r\n"
        . "			)clus\r\n"
        . "			on clus.clientcode=loan.cluscode\r\n"
        . "		left join (select ProdID prodIdProduct, VarValue VarValue from products where VarName='PRODNAME' ) prod\r\n"
        . "			on prod.prodIdProduct=loan.prodid\r\n"
        . "		where lnr not in (select lnr from ldisb) and clcode=''\r\n"
        . "	)loan"
            . "\r\n";
		return $req;
	}

	public function allHajaryTab1Apimf($d) {


		$req=""
        . "select  * from \r\n"
        . "	(\r\n"
        . "		select * from (".$this->ep($d,"S001") . ")s  \r\n"
        . "		union all\r\n"
        . "		select * from (".$this->ep($d,"S002") . ")s  \r\n"
        . "		union all\r\n"
        . "		select * from (".$this->ep($d,"S003") . ")s  \r\n"
        . "		union all\r\n"
        . "		select * from (".$this->ep($d,"S004") . ")s  \r\n"
        . "		union all\r\n"
        . "		select * from (".$this->ep($d,"S005") . ")s  \r\n"
        . "		union all\r\n"
        . "		select * from (".$this->ep($d,"S006") . ")s  \r\n"
        . "		union all\r\n"
        . "		select * from (".$this->ep($d,"S007") . ")s  \r\n"
        . "	)r \r\n"
        . "	 union all\r\n"
        . "\r\n"
        . " \r\n"
        . "  \r\n"
        . "	select clientcode accnr,balance,tday,('T001')prodid,clcode,cluscode,name,surname,sex , ('Hajary Mahatoky')productsname from \r\n"
        . "		(select * from (".$this->dat($d).")s ) dat\r\n"
        . "	\r\n"
        . "		join (select clcode clcode,('indivio') cluscode, max(clname) name,max(clsurname) surname, max(sex) sex from persons group by clcode)pers \r\n"
        . "	on pers.clcode=dat.clientcode where clientcode like '%/I/%' \r\n"
        . "\r\n"
        . "	union all\r\n"
        . "\r\n"
        . "	select clientcode accnr,balance,tday,('T001')prodid,clcode,cluscode,name,surname,sex , ('Hajary Mahatoky')productsname from \r\n"
        . "		(select * from (".$this->dat($d).")s ) dat\r\n"
        . "	\r\n"
        . "		left join (select ('groupeio') clcode, cluscode , max(name) name, max(physadd) surname , ('groupeio') sex from cluster group by cluscode)clus\r\n"
        . "	on clus.cluscode=dat.clientcode where clientcode like '%/B/%' or  clientcode like '%/G/%'"
            . "\r\n";

		return $req;
	}


	public function creditparproduit($date1, $date2) {
        $req=""
        . "		select credit.prodid,prod.productsname,credit.nombre,credit.ldamount,credit.intamount, \r\n"
        . "		credit.prnombre,credit.prldamount, credit.printamount from \r\n"
        . "		(\r\n"
        . "			select  prodid prodid, count(prodid) nombre, sum(ldamount) ldamount, sum(intamount)intamount ,\r\n"
        . "			(  Cast( Round(   count(prodid)*100./sum(count(prodid)) over() ,2 ) as decimal(18,2))  ) prnombre,\r\n"
        . "			( Cast( Round(  sum(ldamount)*100./sum(sum(ldamount)) over()  ,2 ) as decimal(18,2)) ) prldamount,\r\n"
        . "			( Cast( Round(  sum(intamount)*100./sum(sum(intamount)) over()  ,2 ) as decimal(18,2)) ) printamount\r\n"
        . "			from (".$this->creditdateconso($date1, $date2).")c \r\n"
        . "			group by prodid\r\n"
        . "		)credit\r\n"
        . "		left join (select ProdID prodId, VarValue productsname from products where VarName='PRODNAME' ) prod\r\n"
        . "		on prod.prodId=credit.prodid"
            . "\r\n"
    ;
        return $req;
	}


	public function creditnonapprouverdateconso($date) {


		$req=""
        . "select * from\r\n"
        . "	(\r\n"
        . "		select lnr,clientcode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby ,tstart,exp,\r\n"
        . "		name,surname,sex,phone,varvalue productsname\r\n"
        . "		from \r\n"
        . "		(\r\n"
        . "			select lnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby ,tstart,exp\r\n"
        . "			from loan where Approved!='Y' and tstart<='".$date."'  and exp>=(select getdate())\r\n"
        . "		)loan\r\n"
        . "		left join \r\n"
        . "			(\r\n"
        . "				select clcode clientcode,max(clname) name, max(clsurname) surname,max(sex) sex ,max(phone) phone from persons group by clcode\r\n"
        . "			)pers\r\n"
        . "			on pers.clientcode=loan.clcode\r\n"
        . "		left join (select ProdID prodIdProduct, VarValue VarValue from products where VarName='PRODNAME' ) prod\r\n"
        . "			on prod.prodIdProduct=loan.prodid\r\n"
        . "		where lnr not in (select lnr from ldisb) and cluscode=''\r\n"
        . "		union all\r\n"
        . "		select lnr,clientcode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby ,tstart,exp,\r\n"
        . "		name,surname,sex,phone,varvalue productsname from \r\n"
        . "		(\r\n"
        . "			select lnr, clcode clcode,cluscode,lamount,tint,intamount,tuserid,nrin,instype,prodid, appby ,tstart,exp\r\n"
        . "			from loan where Approved!='Y' and tstart<='".$date."'  and exp>=(select getdate())\r\n"
        . "		)loan\r\n"
        . "		left join \r\n"
        . "			(\r\n"
        . "				select cluscode clientcode,name name, physadd surname,('groupeio')sex,('groupeio')phone from cluster\r\n"
        . "			)clus\r\n"
        . "			on clus.clientcode=loan.cluscode\r\n"
        . "		left join (select ProdID prodIdProduct, VarValue VarValue from products where VarName='PRODNAME' ) prod\r\n"
        . "			on prod.prodIdProduct=loan.prodid\r\n"
        . "		where lnr not in (select lnr from ldisb) and clcode=''\r\n"
        . "	)loan"
            . "\r\n"
    ;
		return $req;
	}

	public function budgetallreelconso($date1, $date2) {

      $req=""
        . "select account, \r\n"
        . "	( case when soldeouverture>0 then soldeouverture else 0 end )soldeouverturedebit\r\n"
        . "	, ( case when soldeouverture<0 then -soldeouverture else 0 end  )soldeouverturecredit,\r\n"
        . "	debit,credit,\r\n"
        . "	reeldebit,reelcredit,label,frlabel,eslabel,otlabel,rulabel,agence from \r\n"
        . "	(\r\n"
        . "				select gen.ACCOUNT ,\r\n"
        . "			(\r\n"
        . "				select  ISNULL(sum(debit)-SUM(credit) ,0)  from GENLEDG where ACCOUNT=gen.account   and '".$date1."' <=tday and tday<='".$date2."'  \r\n"
        . "				and (DESCRIPTIO like '%Solde d''ouverture%' or trancode like 'A00')\r\n"
        . "			) soldeouverture,\r\n"
        . "			(\r\n"
        . "				select  ISNULL(sum(debit) ,0)  from GENLEDG where ACCOUNT=gen.account   and '".$date1."' <=tday and tday<='".$date2."'  \r\n"
        . "				and (DESCRIPTIO not like '%Solde d''ouverture%' or trancode not like 'A00')\r\n"
        . "			) debit,\r\n"
        . "			(\r\n"
        . "				select  ISNULL(sum(credit) ,0)  from GENLEDG where ACCOUNT=gen.account   and '".$date1."' <=tday and tday<='".$date2."'  \r\n"
        . "				 and (DESCRIPTIO not like '%Solde d''ouverture%' or trancode not like 'A00')\r\n"
        . "			) credit,\r\n"
        . "		( case when balance>0 then balance else 0 end )reeldebit\r\n"
        . "\r\n"
        . "		, ( case when balance<0 then -balance else 0 end  )reelcredit\r\n"
        . "\r\n"
        . "		,label,frlabel,eslabel,otlabel,rulabel, ('conso')agence from\r\n"
        . "		(\r\n"
        . "			select ACCOUNT ACCOUNT,sum(debit)debit, sum(credit) credit, (sum(debit)-sum(credit))   balance from GENLEDG \r\n"
        . "			where '".$date1."' <=tday and tday<='".$date2."'\r\n"
        . "			group by account\r\n"
        . "		)gen\r\n"
        . "		left join \r\n"
        . "		(\r\n"
        . "			select account ,label,frlabel,eslabel,otlabel,rulabel  from accounts \r\n"
        . "		)acc on acc.account=gen.ACCOUNT\r\n"
        . "		where balance!=0\r\n"
        . "	)a"
          . "\r\n"
    ;

      return $req;
	}

	public function budgetallreelagence($date1, $date2, $agence) {

     $req=""
        . "select account, \r\n"
        . "	( case when soldeouverture>0 then soldeouverture else 0 end )soldeouverturedebit\r\n"
        . "	, ( case when soldeouverture<0 then -soldeouverture else 0 end  )soldeouverturecredit,\r\n"
        . "	debit,credit,\r\n"
        . "	reeldebit, reelcredit,label,frlabel,eslabel,otlabel,rulabel,agence from \r\n"
        . "	(\r\n"
        . "				select gen.ACCOUNT ,\r\n"
        . "			(\r\n"
        . "				select  ISNULL(sum(debit)-SUM(credit) ,0)  from GENLEDG where ACCOUNT=gen.account   and '".$date1."' <=tday and tday<='".$date2."'  \r\n"
        . "				and BranchID='".$agence."' and (DESCRIPTIO like '%Solde d''ouverture%' or trancode like 'A00')\r\n"
        . "			) soldeouverture,\r\n"
        . "			(\r\n"
        . "				select  ISNULL(sum(debit) ,0)  from GENLEDG where ACCOUNT=gen.account   and '".$date1."' <=tday and tday<='".$date2."'  \r\n"
        . "				and BranchID='".$agence."' and (DESCRIPTIO not like '%Solde d''ouverture%' or trancode not like 'A00')\r\n"
        . "			) debit,\r\n"
        . "			(\r\n"
        . "				select  ISNULL(sum(credit) ,0)  from GENLEDG where ACCOUNT=gen.account   and '".$date1."' <=tday and tday<='".$date2."'  \r\n"
        . "				and BranchID='".$agence."' and (DESCRIPTIO not like '%Solde d''ouverture%' or trancode not like 'A00')\r\n"
        . "			) credit,\r\n"
        . "		( case when balance>0 then balance else 0 end )reeldebit\r\n"
        . "\r\n"
        . "		, ( case when balance<0 then -balance else 0 end  )reelcredit\r\n"
        . "\r\n"
        . "		,label,frlabel,eslabel,otlabel,rulabel, ('".$agence."')agence from\r\n"
        . "		(\r\n"
        . "			select ACCOUNT ACCOUNT,sum(debit)debit, sum(credit) credit, (sum(debit)-sum(credit))   balance from GENLEDG \r\n"
        . "			where '".$date1."' <=tday and tday<='".$date2."' and BranchID='".$agence."'\r\n"
        . "			group by account\r\n"
        . "		)gen\r\n"
        . "		left join \r\n"
        . "		(\r\n"
        . "			select account ,label,frlabel,eslabel,otlabel,rulabel  from accounts \r\n"
        . "		)acc on acc.account=gen.ACCOUNT\r\n"
        . "		where balance!=0\r\n"
        . "	)a"
         . "\r\n"
    ;

     return $req;
	}


	public function budgetreelconso($date1, $date2) {
       $req=""
        . "	select account,\r\n"
        . "	Cast( Round( soldeouverturedebit/1000  ,2 ) as decimal(18,2))  soldeouverturedebit,\r\n"
        . "	Cast( Round( soldeouverturecredit/1000   ,2 ) as decimal(18,2)) soldeouverturecredit ,\r\n"
        . "	Cast( Round( debit/1000   ,2 ) as decimal(18,2))  debit,\r\n"
        . "	Cast( Round( credit/1000  ,2 ) as decimal(18,2))   credit,\r\n"
        . "		Cast( Round( ( debit-credit)/1000   ,2 ) as decimal(18,2))  difference,\r\n"
        . "	Cast( Round(  reeldebit/1000  ,2 ) as decimal(18,2))   reeldebit,\r\n"
        . "	Cast( Round(   reelcredit/1000  ,2 ) as decimal(18,2))  reelcredit,\r\n"
        . "	 label,frlabel,eslabel,otlabel,rulabel,agence  \r\n"
        . "	from (".$this->budgetallreelconso($date1, $date2).")c \r\n"
        . "	where  (ACCOUNT like '6%')\r\n"
        . "\r\n"
        . "	union all\r\n"
        . "\r\n"
        . "	select account,\r\n"
        . "	Cast( Round( soldeouverturedebit/1000  ,2 ) as decimal(18,2))  soldeouverturedebit,\r\n"
        . "	Cast( Round( soldeouverturecredit/1000   ,2 ) as decimal(18,2)) soldeouverturecredit ,\r\n"
        . "	Cast( Round( debit/1000   ,2 ) as decimal(18,2))  debit,\r\n"
        . "	Cast( Round( credit/1000  ,2 ) as decimal(18,2))   credit,\r\n"
        . "		Cast( Round( ( credit-debit)/1000   ,2 ) as decimal(18,2))  difference,\r\n"
        . "	Cast( Round(  reeldebit/1000  ,2 ) as decimal(18,2))   reeldebit,\r\n"
        . "	Cast( Round(   reelcredit/1000  ,2 ) as decimal(18,2))  reelcredit,\r\n"
        . "	 label,frlabel,eslabel,otlabel,rulabel,agence  \r\n"
        . "	from (".$this->budgetallreelconso($date1, $date2).")c \r\n"
        . "	where  (ACCOUNT like '7%')\r\n"
        . ""


           . "\r\n";
       return $req;
	}


	public function budgetreelagence($d1, $d2, $agence) {


      $req=""
        . "		select account,\r\n"
        . "	Cast( Round( soldeouverturedebit/1000  ,2 ) as decimal(18,2))  soldeouverturedebit,\r\n"
        . "	Cast( Round( soldeouverturecredit/1000   ,2 ) as decimal(18,2)) soldeouverturecredit ,\r\n"
        . "	Cast( Round( debit/1000   ,2 ) as decimal(18,2))  debit,\r\n"
        . "	Cast( Round( credit/1000  ,2 ) as decimal(18,2))   credit,\r\n"
        . "		Cast( Round( ( debit-credit)/1000   ,2 ) as decimal(18,2))  difference,\r\n"
        . "	Cast( Round(  reeldebit/1000  ,2 ) as decimal(18,2))   reeldebit,\r\n"
        . "	Cast( Round(   reelcredit/1000  ,2 ) as decimal(18,2))  reelcredit,\r\n"
        . "	 label,frlabel,eslabel,otlabel,rulabel,agence  \r\n"
        . "	from (".$this->budgetallreelagence($d1, $d2,$agence).")c \r\n"
        . "	where  (ACCOUNT like '6%')\r\n"
        . "\r\n"
        . "	union all\r\n"
        . "\r\n"
        . "	select account,\r\n"
        . "	Cast( Round( soldeouverturedebit/1000  ,2 ) as decimal(18,2))  soldeouverturedebit,\r\n"
        . "	Cast( Round( soldeouverturecredit/1000   ,2 ) as decimal(18,2)) soldeouverturecredit ,\r\n"
        . "	Cast( Round( debit/1000   ,2 ) as decimal(18,2))  debit,\r\n"
        . "	Cast( Round( credit/1000  ,2 ) as decimal(18,2))   credit,\r\n"
        . "		Cast( Round( ( credit-debit)/1000   ,2 ) as decimal(18,2))  difference,\r\n"
        . "	Cast( Round(  reeldebit/1000  ,2 ) as decimal(18,2))   reeldebit,\r\n"
        . "	Cast( Round(   reelcredit/1000  ,2 ) as decimal(18,2))  reelcredit,\r\n"
        . "	 label,frlabel,eslabel,otlabel,rulabel,agence  \r\n"
        . "	from (".$this->budgetallreelagence($d1, $d2,$agence).")c \r\n"
        . "	where  (ACCOUNT like '7%')"

          . "\r\n";
      return $req;
	}


	public function totalcreditproduitintervalleConso($date1, $date2, $nomproduit) {

     $req=""
        . "		select ('".$nomproduit."') produit,count(*) nombre,isnull(sum(ldamount),0) montant , ('".$date1."') date1, ('".$date2."') date2,\r\n"
        . "		('conso') agence\r\n"
        . "		from (".$this->creditdateconso($date1, $date2).")cc \r\n"
        . "		where productsname like '%'+'".$nomproduit."'+'%'"
         . "\r\n";
     return $req;
	}


	public function totalcreditallproduitintervalleconso($date1, $date2) {


    $req=""
        . "		select * from (".$this->totalcreditproduitintervalleConso($date1, $date2, "C.A.E").")c \r\n"
        . "		union all\r\n"
        . "		select ('C.I.M.E') produit,count(*) nombre,isnull(sum(ldamount),0) montant ,  \r\n"
        . "		('".$date1."') date1, ('".$date2."') date2,('conso') agence\r\n"
        . "		from (".$this->creditdateconso($date1, $date2).")cc where  \r\n"
        . "			  productsname like '%C.I.M.E%' and \r\n"
        . "			productsname not like '%CSOL%'\r\n"
        . "\r\n"
        . "		union all\r\n"
        . "		select * from (".$this->totalcreditproduitintervalleConso($date1, $date2, "CSOL").")c \r\n"
        . "		union all\r\n"
        . "		select * from (".$this->totalcreditproduitintervalleConso($date1, $date2, "C.I.P.S").")c\r\n"
        . "		union all\r\n"
        . "		select * from (".$this->totalcreditproduitintervalleConso($date1, $date2, "LVE").")c\r\n"
        . "		union all\r\n"
        . "		select * from (".$this->totalcreditproduitintervalleConso($date1, $date2, "C.S.G.R").")c\r\n"
        . "		union all\r\n"
        . "		select * from (".$this->totalcreditproduitintervalleConso($date1, $date2, "C.S.M.E").")c\r\n"
        . "		union all\r\n"
        . "		select * from (".$this->totalcreditproduitintervalleConso($date1, $date2, "C.P.M.E").")c\r\n"

    ;
    return $req;
	}



	public function totalcreditproduitintervalleagence($date1, $date2, $agence, $nomproduit) {

		$req=""
        . "		select ('".$nomproduit."') produit,count(*) nombre,isnull(sum(ldamount),0) montant , ('".$date1."') date1, ('".$date2."') date2,\r\n"
        . "		('".$agence."') agence\r\n"
        . "		from (".$this->creditdateagence($date1, $date2, $agence).")cc \r\n"
        . "		where productsname like '%'+'".$nomproduit."'+'%' "


            . "\r\n";
		return $req;
	}


	public function totalcreditallproduitintervalleagence($date1, $date2, $agence) {
		$req=""
        . "		select * from (".$this->totalcreditproduitintervalleagence($date1, $date2, $agence,"C.A.E").")c  \r\n"
        . "		union all\r\n"
        . "				\r\n"
        . "	select ('C.I.M.E') produit,count(*) nombre,isnull(sum(ldamount),0) montant , ('".$date1."') date1, ('".$date2."') date2,\r\n"
        . "		('".$agence."') agence\r\n"
        . "		from (".$this->creditdateagence($date1, $date2, $agence).")cc \r\n"
        . "		where productsname like '%'+'C.I.M.E'+'%' and productsname not like '%CSOL%'"
        . ""
        . "\r\n"
        . "		union all\r\n"
        . "		select * from (".$this->totalcreditproduitintervalleagence($date1, $date2, $agence,"CSOL").")c  \r\n"
        . "		union all\r\n"
        . "		select * from (".$this->totalcreditproduitintervalleagence($date1, $date2, $agence,"C.I.P.S").")c  \r\n"
        . "		union all\r\n"
        . "		select * from (".$this->totalcreditproduitintervalleagence($date1, $date2, $agence,"LVE").")c  \r\n"
        . "		union all\r\n"
        . "		select * from (".$this->totalcreditproduitintervalleagence($date1, $date2, $agence,"C.S.G.R").")c  \r\n"
        . "		union all\r\n"
        . "		select * from (".$this->totalcreditproduitintervalleagence($date1, $date2, $agence,"C.S.M.E").")c  \r\n"
        . "		union all\r\n"
        . "		select * from (".$this->totalcreditproduitintervalleagence($date1, $date2, $agence,"C.P.M.E").")c  \r\n"


    ;
		return $req;
	}

	public function datdetailleconso($date) {


		$req=""
        . "select dat.*,('T001')prodid, dat.accnr clcode,('indivio') cluscode,pers.clname name,pers.clsurname surname,pers.sex sex , ('Hajary Mahatoky') productsname  from \r\n"
        . "			(\r\n"
        . "				select  clientcode accnr,balance,tday \r\n"
        . "				from (".$this->dat($date).")cc \r\n"
        . "				where  balance>0 and clientcode like '%/I/%'\r\n"
        . "			)dat\r\n"
        . "			left join (\r\n"
        . "			select * from\r\n"
        . "								(\r\n"
        . "				select *,\r\n"
        . "				ROW_NUMBER() OVER(PARTITION BY p.clcode ORDER BY p.memdate DESC) AS rk1\r\n"
        . "				from persons p where clcode!=''\r\n"
        . "				)s\r\n"
        . "				where rk1=1 \r\n"
        . "			)pers on pers.clcode=dat.accnr\r\n"
        . "\r\n"
        . "			union all\r\n"
        . "\r\n"
        . "			select dat.*,('T001')prodid, ('groupeio') clcode,dat.accnr cluscode,c.name name,c.physadd surname,('groupeio') sex , ('Hajary Mahatoky') productsname  from \r\n"
        . "			(\r\n"
        . "				select  clientcode accnr,balance,tday\r\n"
        . "				from (".$this->dat($date).")cc \r\n"
        . "				where  balance>0 and clientcode like '%/G/%' or clientcode ='' or clientcode like '%/B/%' \r\n"
        . "			)dat\r\n"
        . "			left join cluster c on c.cluscode=dat.accnr"

            . "\r\n";

		return $req;
	}



	public function datdetailleagence($date, $agence) {


		$req=""
        . "	select * from \r\n"
        . "	(".$this->datdetailleconso($date).")cc	 \r\n"
        . "		where accnr like '".$agence."'+'/%'"
            . "\r\n";

		return $req;
	}


	public function allhajaryconso($date) {


		$req=""
        . "		select * from  ( ".$this->ep($date, "S001").")c  \r\n"
        . "		union all\r\n"
        . "		select * from  ( ".$this->ep($date, "S002").")c  \r\n"
        . "		union all\r\n"
        . "		select * from  ( ".$this->ep($date, "S003").")c  \r\n"
        . "		union all\r\n"
        . "		select * from  ( ".$this->ep($date, "S004").")c  \r\n"
        . "		union all\r\n"
        . "		select * from  ( ".$this->ep($date, "S005").")c  \r\n"
        . "		union all\r\n"
        . "		select * from  ( ".$this->ep($date, "S006").")c  \r\n"
        . "		union all\r\n"
        . "		select * from  ( ".$this->ep($date, "S007").")c  \r\n"
        . "		union all\r\n"
        . "		select * from  (".$this->datdetailleconso($date).") dat "
        . ""
            . "\r\n";

		return $req;
	}

	public function allhajaryagence($date, $agence) {


		$req=""
        . "select * from (".$this->allhajaryconso($date).")cc where accnr like '".$agence."'+'/%'"
            . "\r\n";
		return $req;
	}


	public function totalallhajaryagence($date1,$date2 , $agence) {
		$req=""
        . "		select *, (balance2-balance1) balance,(nombre2-nombre1)nombre from\r\n"
        . "	(\r\n"
        . "		select ISNULL(r1.productsname1,r2.productsname2) productsname,ISNULL(balance1,0) balance1,ISNULL(nombre1,0) nombre1,date1,\r\n"
        . "	   isnull(balance2,0) balance2,ISNULL(nombre2,0) nombre2 ,date2 \r\n"
        . "	   from \r\n"
        . "		(\r\n"
        . "			select productsname productsname1,sum(balance) balance1,\r\n"
        . "			count(*) nombre1 , ('".$date1."')date1 \r\n"
        . "			from (".$this->allhajaryagence($date1, $agence).")cc \r\n"
        . "			group by productsname \r\n"
        . "		)r1\r\n"
        . "		full join \r\n"
        . "		(\r\n"
        . "			select productsname productsname2,sum(balance) balance2,\r\n"
        . "			count(*) nombre2 , ('".$date2."')date2 \r\n"
        . "			from (".$this->allhajaryagence($date2, $agence).")cc \r\n"
        . "			group by productsname \r\n"
        . "		)r2\r\n"
        . "		on r2.productsname2=r1.productsname1\r\n"
        . "	)r"
            . "\r\n"
    ;

		return $req;
	}
	public function totalallhajaryconso($date1, $date2) {


		$req=""
        . "	select *, (balance2-balance1) balance,(nombre2-nombre1)nombre from\r\n"
        . "	(\r\n"
        . "		select ISNULL(r1.productsname1,r2.productsname2) productsname,ISNULL(balance1,0) balance1,ISNULL(nombre1,0) nombre1,date1,\r\n"
        . "	   isnull(balance2,0) balance2,ISNULL(nombre2,0) nombre2 ,date2 \r\n"
        . "	   from \r\n"
        . "		(\r\n"
        . "			select productsname productsname1,sum(balance) balance1,\r\n"
        . "			count(*) nombre1 , ('".$date1."')date1 \r\n"
        . "			from (".$this->allhajaryconso($date1).")cc \r\n"
        . "			group by productsname \r\n"
        . "		)r1\r\n"
        . "		full join \r\n"
        . "		(\r\n"
        . "			select productsname productsname2,sum(balance) balance2,\r\n"
        . "			count(*) nombre2 , ('".$date2."')date2 \r\n"
        . "			from (".$this->allhajaryconso($date2).")cc \r\n"
        . "			group by productsname \r\n"
        . "		)r2\r\n"
        . "		on r2.productsname2=r1.productsname1\r\n"
        . "	)r"
            . "\r\n"
    ;

		return $req;
	}



	public function parproduitconso ($date) {


		$req=""
        . "	select productsname productsname, count(*) nombre, sum(portefeuille) portefeuille ,\r\n"
        . "	( Cast( Round((       sum(portefeuille)*100/sum(sum(portefeuille)) over()      ),2 ) as decimal(18,2))) pourcentage,\r\n"
        . "	(sum(sum(portefeuille)) over()) total,\r\n"
        . "	retardbilan retardbilan, ('conso')agence\r\n"
        . "	from (".$this->parconsodetaille($date).")cc \r\n"
        . "	group by productsname, retardbilan "
            . "\r\n"


    ;

		return $req;
	}

	public function parproduitagence($date, $agence) {


		$req=""
        . "	select productsname productsname, count(*) nombre, sum(portefeuille) portefeuille ,\r\n"
        . "	( Cast( Round((       sum(portefeuille)*100/sum(sum(portefeuille)) over()      ),2 ) as decimal(18,2))) pourcentage,\r\n"
        . "	(sum(sum(portefeuille)) over()) total,\r\n"
        . "	retardbilan retardbilan, ('".$agence."')agence\r\n"
        . "	from (".$this->paragencedetaille($date, $agence).")cc \r\n"
        . "	group by productsname, retardbilan "

            . "\r\n";

		return $req;
	}

//	parproduitliste1: Misy ny Liste ANana Produit rehetra(Ankoatran ny  LVE, CSOL , Stockage  ...) miaraka am ny retardbilan rehetra ==> Liste Tsutra ftsn io
	public function parproduitliste1() {
$req=""
    . "	select * from\r\n"
    . "	(\r\n"
    . "	select VarValue productsname from Products where VarName='Prodname' and VarValue like 'C.%' and \r\n"
    . "	VarValue not like '%Stockage%' and VarValue not like '%LVE%' and VarValue not like '%L.V.E%' and VarValue not like '%CSOL%'\r\n"
    . "	)prod  ,(select * from (".$this->lrb().")l )lrb"
    . "\r\n";
		return $req;
	}

//	parproduitliste2: Misy ny Liste ANana Produit rehetra( LVE, CSOL , Stckage ftsn...)
	public function parproduitliste2 () {
$req=""
    . "	select * from\r\n"
    . "	(\r\n"
    . "		select VarValue productsname from Products where VarName='Prodname' and VarValue like 'C.%' and \r\n"
    . "		VarValue  like '%Stockage%' or VarValue  like '%LVE%' or VarValue  like '%L.V.E%' or VarValue  like '%CSOL%'\r\n"
    . "		)prod  ,\r\n"
    . "	(select * from (".$this->lrb().")l )lrb "
    . "\r\n";

		return $req;
	}
//
	public function parproduitconso1($date) {


		$req=""
        . "		select liste.productsname,\r\n"
        . "				isnull(par.nombre,0) nombre,isnull(par.portefeuille,0) portefeuille,isnull(par.pourcentage,0) pourcentage,\r\n"
        . "				isnull(par.total,0) total,liste.retardbilan,isnull(par.agence,'conso') agence\r\n"
        . "		from \r\n"
        . "		(\r\n"
        . "			select * from (".$this->parproduitliste1().")cc \r\n"
        . "		)liste\r\n"
        . "		left join \r\n"
        . "		(\r\n"
        . "			select * from (".$this->parproduitconso($date).")ccc  \r\n"
        . "		)par on liste.retardbilan=par.retardbilan and liste.productsname=par.productsname"

            . "\r\n";

		return $req;
	}

	public function parproduitconso2($date) {


		$req=""
        . "		select liste.productsname,\r\n"
        . "				isnull(par.nombre,0) nombre,isnull(par.portefeuille,0) portefeuille,isnull(par.pourcentage,0) pourcentage,\r\n"
        . "				isnull(par.total,0) total,liste.retardbilan,isnull(par.agence,'conso') agence\r\n"
        . "		from \r\n"
        . "		(\r\n"
        . "			select * from (".$this->parproduitliste2().")cc \r\n"
        . "		)liste\r\n"
        . "		left join \r\n"
        . "		(\r\n"
        . "			select * from (".$this->parproduitconso($date).")ccc  \r\n"
        . "		)par on liste.retardbilan=par.retardbilan and liste.productsname=par.productsname"

            . "\r\n";

		return $req;
	}



	public function parproduitconsoresumer($date) {


		$req=""
        . "		select substring(productsname,0,8)productsname \r\n"
        . "				,sum(nombre) nombre, sum(portefeuille) portefeuille\r\n"
        . "				,sum(pourcentage) pourcentage,max(total)total\r\n"
        . "		, retardbilan  ,  max(agence) agence  \r\n"
        . "		from (".$this->parproduitconso1($date).")cc \r\n"
        . "			group by substring(productsname,0,8), retardbilan \r\n"
        . "			\r\n"
        . "			union all\r\n"
        . "			select substring(productsname,9,4)productsname \r\n"
        . "					,sum(nombre) nombre, sum(portefeuille) portefeuille\r\n"
        . "				,sum(pourcentage) pourcentage,max(total)total\r\n"
        . "		, retardbilan  ,  max(agence) agence \r\n"
        . "		from (".$this->parproduitconso2($date).")cc \r\n"
        . "		group by substring(productsname,9,4), retardbilan "

            . "\r\n";

		return $req;
	}

	public function parproduitagence1($d, $agence) {


		$req=""
        . "		select liste.productsname,\r\n"
        . "				isnull(par.nombre,0) nombre,isnull(par.portefeuille,0) portefeuille,isnull(par.pourcentage,0) pourcentage,\r\n"
        . "				isnull(par.total,0) total,liste.retardbilan,isnull(par.agence,'".$agence."') agence\r\n"
        . "		from \r\n"
        . "		(\r\n"
        . "			select * from (".$this->parproduitliste1().")cc \r\n"
        . "		)liste\r\n"
        . "		left join \r\n"
        . "		(\r\n"
        . "			select * from (".$this->parproduitagence($d,$agence).")cc \r\n"
        . "		)par on liste.retardbilan=par.retardbilan and liste.productsname=par.productsname"

            . "\r\n";

		return $req;
	}
//
	public function parproduitagence2($d, $agence) {


		$req=""
        . "		select liste.productsname,\r\n"
        . "				isnull(par.nombre,0) nombre,isnull(par.portefeuille,0) portefeuille,isnull(par.pourcentage,0) pourcentage,\r\n"
        . "				isnull(par.total,0) total,liste.retardbilan,isnull(par.agence,'".$agence."') agence\r\n"
        . "		from \r\n"
        . "		(\r\n"
        . "			select * from (".$this->parproduitliste2().")cc \r\n"
        . "		)liste\r\n"
        . "		left join \r\n"
        . "		(\r\n"
        . "			select * from (".$this->parproduitagence($d,$agence).")cc \r\n"
        . "		)par on liste.retardbilan=par.retardbilan and liste.productsname=par.productsname"

            . "\r\n";

		return $req;
	}

	public function parproduitagenceresumer($d, $agence) {


	$req=""
        . "select substring(productsname,0,8)productsname \r\n"
        . "				,sum(nombre) nombre, sum(portefeuille) portefeuille\r\n"
        . "				,sum(pourcentage) pourcentage,max(total)total\r\n"
        . "		, retardbilan  ,  max(agence) agence\r\n"
        . "		from (".$this->parproduitagence1($d,$agence).")cc \r\n"
        . "			group by substring(productsname,0,8), retardbilan \r\n"
        . "			\r\n"
        . "			union all\r\n"
        . "			select substring(productsname,9,4)productsname \r\n"
        . "				,sum(nombre) nombre, sum(portefeuille) portefeuille\r\n"
        . "				,sum(pourcentage) pourcentage,max(total)total\r\n"
        . "		, retardbilan  ,  max(agence) agence\r\n"
        . "		 \r\n"
        . "		from (".$this->parproduitagence2($d,$agence).")cc \r\n"
        . "		group by substring(productsname,9,4), retardbilan "

        . "\r\n";

	return $req;
}


	public function budgetdetailleagence($date1, $date2,$account, $agence) {
		$req=""
        . "select   GENLEDG.account,tday,DESCRIPTIO,debit,credit,voucher,GENLEDG.prodid,BRANCHID, \r\n"
        . "ENTRYDATE,label,frlabel,eslabel,otlabel,rulabel,productsname from \r\n"
        . "(select  account,tday,DESCRIPTIO,debit,credit,voucher,prodid,BRANCHID, ENTRYDATE from GENLEDG)GENLEDG\r\n"
        . "left join (select account,label,frlabel,eslabel,otlabel,rulabel from accounts)account on account.account=GENLEDG.ACCOUNT\r\n"
        . "left join \r\n"
        . "(select ProdID,VarValue productsname from products where varname='PRODNAME')products on GENLEDG.prodid=products.ProdID\r\n"
        . "where '".$date1."' <=tday and  tday<='".$date2."' and  GENLEDG.account like '%".$account."%' and BRANCHID='".$agence."'"
            . "\r\n";
		return $req;
	}

	public function budgetdetailleconso($date1, $date2,$account) {


		$req=""
        . "select   GENLEDG.account,tday,DESCRIPTIO,debit,credit,voucher,GENLEDG.prodid,BRANCHID, \r\n"
        . "ENTRYDATE,label,frlabel,eslabel,otlabel,rulabel,productsname from \r\n"
        . "(select  account,tday,DESCRIPTIO,debit,credit,voucher,prodid,BRANCHID, ENTRYDATE from GENLEDG)GENLEDG\r\n"
        . "left join (select account,label,frlabel,eslabel,otlabel,rulabel from accounts)account on account.account=GENLEDG.ACCOUNT\r\n"
        . "left join \r\n"
        . "(select ProdID,VarValue productsname from products where varname='PRODNAME')products on GENLEDG.prodid=products.ProdID\r\n"
        . "where '".$date1."' <=tday and  tday<='".$date2."' and  GENLEDG.account like '%".$account."%' "
            . "\r\n";
		return $req;
	}
  }

?>

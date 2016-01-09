<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Push_notification_model_demo extends CI_Model{
    function __construct(){
        parent::__construct();

    }

    function push_notification_brand_users($data){
        $this->db->insert('push_notification_brand_users',$data);
        return $this->db->insert_id();
    }

    function save_push_notification_text($data){
        $this->db->insert('push_notification_text',$data);
        return $this->db->insert_id();
    }

    function get_device_details($id){
        $this->db->select('device_id');
        $this->db->from('device_master');
        $this->db->where('iUserId',$id);
        $query = $this->db->get();
        return $query->row_array();   
    }

    function getAllActiveUsers(){
        $this->db->select('');
        $this->db->from('users');
        $this->db->where('eStatus','Active');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_notofication_users($iPushNotificationId){
        $this->db->select('u.iUserId,u.vFirstName,u.vLastName,u.vEmail');
        $this->db->from('push_notification_brand_users p');
        $this->db->join('users u','p.iUserId=u.iUserId');
        $this->db->where('p.iPushNotificationId',$iPushNotificationId);
        $query = $this->db->get();
        return $query->result_array();   
    }

    function get_push_notification_text(){
        $this->db->select('');
        $this->db->from('push_notification_text');
        $this->db->order_by('iPushNotificationId','desc');
        $query = $this->db->get();
        return $query->result_array();   
    }

    function get_genere_details($value){
        $this->db->select('iGenreId,vGenre');
        $this->db->from('genres');
        $this->db->where('eStatus','Active');
        $this->db->where('iGenreId',$value);
        $que = $this->db->get();
        return $que->row_array();
    }

    function get_all_playlist_from_genere($value,$iBrandActivationCodeId){
        $this->db->select('p.iPlayListId,p.vPlaylist');
        $this->db->from('playlists p');
        $this->db->join('playlists_brands pb','p.iPlayListId=pb.iPlayListId');
        $this->db->where('p.iGenreId',$value);
        $this->db->where('p.eStatus','Active');
        $this->db->where('pb.iBrandActivationCodeId',$iBrandActivationCodeId);
        $this->db->where('pb.eStatus','Active');
        $que = $this->db->get();
        return $que->result_array();
    }

    function get_genere_from_playlistid($iPlayListId){
        $this->db->select('g.iGenreId,g.vGenre');
        $this->db->from('playlists p');
        $this->db->join('genres g','p.iGenreId=g.iGenreId');
        $this->db->where('p.iPlayListId',$iPlayListId);
        $que = $this->db->get();
        return $que->row_array();
    }

    function get_all_songs_in_playlist($iPlayListId){
        $this->db->select('s.iSongId,s.tTitle');
        $this->db->from('playlists_songs ps');
        $this->db->join('playlists p','ps.iPlayListId=p.iPlayListId');
        $this->db->join('songs s','ps.iSongId=s.iSongId');
        $this->db->where('ps.iPlayListId',$iPlayListId);
        $this->db->where('s.eStatus','Active');
        $que = $this->db->get();
        return $que->result_array();
    }   

    function save_song_details($data){
        $this->db->insert('songs',$data);
        return $this->db->insert_id();
    }

    function get_all_brands(){
        $this->db->select('');
        $this->db->from('brands');
        $this->db->order_by('iBrandId','desc');
        $query = $this->db->get();
        return $query->result_array();   
    }

    function get_update_all($ids,$action){
        $data = array('eStatus' =>$action);
        $this->db->where_in('iBrandId', $ids);
        $this->db->update('brands', $data);
        return $this->db->affected_rows();   
    }

    function get_all_genre(){
        $this->db->select('*');
        $this->db->from('genres');
        $this->db->where('eStatus','Active');
        $query = $this->db->get();
        return $query->result_array(); 
    }

    function delete_all($ids){

        $this->db->where_in('iBrandId', $ids);
        $this->db->delete('brands'); 
        $this->db->where_in('iBrandId', $ids);
        $this->db->delete('brand_activationcode_files');

    }
    function delete_prerecord($ids)
    {
        $this->db->select('iActivationCodeId');
        $this->db->where_in('iBrandId', $ids);
        $this->db->get('brands_activationcodes');
        $query=$this->db->last_query();
        $this->db->select('iBrandActivationCodeId');
        $this->db->where_in('iBrandId', $ids);
        $this->db->get('brands_activationcodes');
        $query2=$this->db->last_query();
        $this->db->where("iBrandActivationCodeId in ($query2)");
        $this->db->delete('playlists_brands');   
        $this->db->where("iActivationCodeId in ($query)");
        $this->db->delete('activationcodes');
        $this->db->where("iActivationCodeId in ($query)");
        $this->db->delete('users_activationcodes');
        $this->db->where_in('iBrandId', $ids);
        $this->db->delete('brands_activationcodes');

    }

    function get_one_brand($iBrandId){
        $this->db->select('');
        $this->db->from('brands');
        $this->db->where('iBrandId',$iBrandId);
        $query = $this->db->get();
        return $query->row_array(); 
    }

    function get_brand_activationcode($iBrandId){
        $this->db->select('b.iBrandId,ba.iBrandId,a.iActivationCodeId,ba.iActivationCodeId,a.vActivation,ba.iBrandActivationCodeId');
        $this->db->from('brands b');
        $this->db->join('brands_activationcodes ba','b.iBrandId=ba.iBrandId');
        $this->db->join('activationcodes a','ba.iActivationCodeId=a.iActivationCodeId');
        $this->db->where('b.iBrandId',$iBrandId);
        $this->db->order_by('a.iActivationCodeId', 'desc');
        $query = $this->db->get();
        return $query->result_array(); 
    }

     function get_one_brand_image($iBrandId){
        $this->db->select('bi.iBrandId,bi.vImage,b.iBrandId');
        $this->db->from('brand_image bi');
        $this->db->join('brands b','bi.iBrandId=b.iBrandId');
        $this->db->where('bi.iBrandId',$iBrandId);
        $query = $this->db->get();
        return $query->row_array();    
    }

    function get_Playlist_byactcodes($iBrandActivationCodeId){
        $this->db->select('p.iPlayListId,p.vPlaylist');
        $this->db->from('brands b');
        $this->db->join('brands_activationcodes ba','b.iBrandId=ba.iBrandId');
        $this->db->join('playlists_brands pb','ba.iBrandActivationCodeId=pb.iBrandActivationCodeId');
        $this->db->join('playlists p','pb.iPlayListId =p.iPlayListId');
        $this->db->where('pb.iBrandActivationCodeId',$iBrandActivationCodeId);
        $query = $this->db->get();
        //return $query->num_rows();
        return $query->result_array(); 
    }

    function update_brand($brands_id,$data){
        $this->db->where('iBrandId', $brands_id);
        $this->db->update('brands', $data);
        return $this->db->affected_rows();
    }

    function get_admin_photos($id){
        $this->db->select('vPhoto');
        $this->db->from('administrator');
        $this->db->where('iAdminId',$id);
        $query = $this->db->get();
        $result = $query->row_array();   
        return $result['vPhoto'];
    }

    function get_brandimage($iBrandId){
        $this->db->select('iBrandId,vLogo,vTopBar,vSplashScreen,vImage');
        $this->db->from('brands');
        $this->db->where('iBrandId',$iBrandId);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete_image($tableData){
        $data[$tableData['image_field']] = '';
        $this->db->where($tableData['update_field'], $tableData['field_id']);
        return $this->db->update($tableData['tablename'], $data);        
    }

    function brandname(){   
        $this->db->select('iBrandId','vCompanyName');    
        $query=$this->db->get('brands');
        return $query->result_array();
    }    

    function get_subscribeuser_activationcode(){
        $this->db->select('u.vFirstName,u.vLastName,u.vEmail,ua.iActivationCodeId,a.iActivationCodeId,a.vActivation,u.eStatus,b.iBrandId');
        $this->db->from('brands b');
        $this->db->join('brands_activationcodes ba','b.iBrandId=ba.iBrandId');
        $this->db->join('users_activationcodes ua','ba.iActivationCodeId=ua.iActivationCodeId');
        $this->db->join('activationcodes a','ua.iActivationCodeId=a.iActivationCodeId');
        $this->db->join('users u','ua.iUserId=u.iUserId');
        $this->db->where('u.eStatus' ,'Active' );
        $query = $this->db->get();
        return $query->result_array(); 
    }

    function get_brand_playlist($iBrandId){
        $this->db->select('b.*,p.iPlayListId,p.vPlaylist');
        $this->db->from('brands b');
        $this->db->join('brands_activationcodes ba','b.iBrandId=ba.iBrandId');
        $this->db->join('playlists_brands pb','ba.iBrandActivationCodeId=pb.iBrandActivationCodeId');   
        $this->db->join('playlists p','pb.iPlayListId=p.iPlayListId');
        $this->db->where('b.iBrandId',$iBrandId);
        $query = $this->db->get();
        return $query->result_array(); 
    }

    function get_actCodeFilesName($iBrandId){
        $this->db->select('vActivationCodeFile as filename,iTotalCodes,iPlayLists');
        $this->db->from('brand_activationcode_files');
        $this->db->where('iBrandId' ,$iBrandId );
        $query = $this->db->get();
        return $query->result_array(); 
    }

    function check_brand_email($vEmailId){
        $this->db->select('iBrandId,vEmailId');
        $this->db->from('brands');
        $this->db->where('vEmailId',$vEmailId);
        $query = $this->db->get();
        return $query->row_array();
    }

    function saveData($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    function saveBrandImgData($table,$data){
       $this->db->insert($table,$data);
       return $this->db->insert_id();
    }

    function ins_brand_act_code($data){
        $this->db->insert('brands_activationcodes',$data);
        return $this->db->insert_id();
    }

    function add_brand($data){
        $query=$this->db->insert('brands', $data);
        return $this->db->insert_id();
    }

    function ins_act_code($data){
        $this->db->insert('activationcodes',$data);
        return $this->db->insert_id();
    } 

    function playlist($code,$br_id){

        $this->db->select('iActivationCodeId');
        $this->db->from('activationcodes');
        $this->db->where('vActivation',$code);
        $this->db->get();
        $query=$this->db->last_query();
        $this->db->select('iBrandActivationCodeId');
        $this->db->from('brands_activationcodes');
        $this->db->where('iBrandId',$br_id);
        $this->db->where("iActivationCodeId in ($query)");
        $this->db->get();
        $query2=$this->db->last_query();
        $this->db->select('iPlayListId');
        $this->db->from('playlists_brands');
        $this->db->where("iBrandActivationCodeId in ($query2)");
        $this->db->get();
        $query3=$this->db->last_query();
        $this->db->select('vPlaylist');
        $this->db->from('playlists');
        $this->db->where("iPlayListId in ($query3)");
        $query4=$this->db->get();
        return $result=$query4->result_array();      
    }

    function getUserActivationCodes($iUserId){
        $this->db->select('iActivationCodeId');
        $this->db->from('users_activationcodes');
        $this->db->where('iUserId',$iUserId);
        $this->db->get();
        $query=$this->db->last_query();
        $this->db->select('vActivation');
        $this->db->from('activationcodes');
        $this->db->where("iActivationCodeId in ($query)");
        $query2=$this->db->get();
        return $query2->result_array(); 

    }

    function activation_listing($brand_id){
        $this->db->select('iActivationCodeId');
        $this->db->from('brands_activationcodes');
        $this->db->where('iBrandId',$brand_id);
        $this->db->get();
        $query=$this->db->last_query();

        $this->db->select('');
        $this->db->from('activationcodes');
        $this->db->where("iActivationCodeId in ($query)");
        $query=$this->db->get();
        $result=$query->result_array();
        $c=count($result);
        for($i=0;$i<$c;$i++){ 
            $this->db->select('iUserId');
            $this->db->where('iActivationCodeId',$result[$i]['iActivationCodeId']);
            $this->db->from('users_activationcodes');
            $this->db->get();
            $query=$this->db->last_query();

            $this->db->select('vFirstName,vLastName');
            $this->db->where("iUserId IN ($query)");
            $this->db->from('users');
            $que2 = $this->db->get();
            $result2=$que2->row_array();
            $result[$i]['vFirstName']=$result2['vFirstName'];
            $result[$i]['vLastName']=$result2['vLastName'];

            $this->db->select('iBrandActivationCodeId');
            $this->db->from('brands_activationcodes');
            $this->db->where('iActivationCodeId',$result[$i]['iActivationCodeId']);
            $que3 = $this->db->get();
            $result3=$que3->row_array();
            $result[$i]['iBrandActivationCodeId']=$result3['iBrandActivationCodeId'];
        }   
        return $result;
    }

    function get_termscondition(){
        $this->db->select('*');
        $this->db->from('termscondition');
        $query = $this->db->get();
        return $query->row_array(); 
    }
    
    function update_termcondition($data){
        $this->db->update('termscondition', $data);
        return $this->db->affected_rows();
    } 

    function checkSongsAvailable($ISRC){
        $this->db->select('iSongId,vSong,ISRC');
        $this->db->from('songs');
        $this->db->where('ISRC',$ISRC);
        $query = $this->db->get();
        return $query->row_array();      
    }

    function updateSongs($allsongsarr,$iSongId){
        $this->db->where('iSongId', $iSongId);
        $this->db->update('songs', $allsongsarr);      
        return $this->db->affected_rows();
    }

    function getAllBrands(){
        $this->db->select('iBrandId,vCompanyName');
        $this->db->from('brands');
        $query = $this->db->get();
        return $query->result_array();   
    }

    function getActivationCodeByiBrandId($iBrandId){
        $this->db->select('u.iUserId,u.vFirstName,u.vLastName');
        $this->db->from('brands_activationcodes as ba');
        $this->db->join('users_activationcodes as ua','ba.iActivationCodeId=ua.iActivationCodeId');
        $this->db->join('users as u','ua.iUserId=u.iUserId');
        $this->db->where('ba.iBrandId',$iBrandId);
        $this->db->group_by('u.iUserId');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>
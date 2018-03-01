<?php

class myclass
{
    public static function  myfun($id, $action, $name)
    {
        @$items = $_SESSION['items'];
        $dbInstance = DBFunctions::GetDBInstance();
        $strSql = "select * from products p left join category c on p.CategoryID = c.CategoryID where ProductID = '$id'";
        $result = $dbInstance->GetQueryResult($strSql);
        $row = $result->fetch_assoc();

        switch ($action)
        {
            case 'add':
                if(@$items[$id]['names'] == $name && $items[$id]['itemsid'] == $id)
                {
                    $items[$id]['itemsid'] = $id;
                    $items[$id]['categoryname'] = $row['CategoryName'];
                    $items[$id]['names'] = $name;
                    @$items[$id]['number'] += 1;
                    @$items[$id]['unitprice'] = $row['UnitPrice'];
                    $numbers = @$items[$id]['number'] ;
                    $price = @$items[$id]['unitprice'];
                    @$_SESSION["sub"] += $price;
                    @$_SESSION["gst"] =  @$_SESSION["sub"]*0.15;
                    @$_SESSION["total"] = @$_SESSION["gst"] + @$_SESSION["sub"];

                }else {
                    $items[$id]['itemsid'] = $id;
                    $items[$id]['categoryname'] = $row['CategoryName'];
                    $items[$id]['names'] = $name;
                    @$items[$id]['number'] = 1;
                    @$items[$id]['unitprice'] = $row['UnitPrice'];
                    $numbers = @$items[$id]['number'] ;
                    $price = @$items[$id]['unitprice'];
                    @$_SESSION["gst"] += $numbers*$price*0.15;
                    @$_SESSION["sub"] += $numbers*$price;
                    @$_SESSION["total"] = @$_SESSION["gst"] + @$_SESSION["sub"];
                }
                break;
            case 'remove':
                if($items[$id]['itemsid'] == $id)
                {
                    @$items[$id]['number'] -= 1;
                    $price = @$items[$id]['unitprice'];
                    @$_SESSION["sub"] -= $price;
                    @$_SESSION["gst"] =  @$_SESSION["sub"]*0.15;
                    @$_SESSION["total"] = @$_SESSION["gst"] + @$_SESSION["sub"];

                }
                break;
            case 'clear':
                unset($_SESSION['items']);
                unset($_SESSION['sub']);
                unset($_SESSION['gst']);
                unset($_SESSION['total']);
                break;
        }
        if ($action != 'clear')
        {
            @$_SESSION["items"] = $items;
        }
        header("location:index.php");
    }
}

?>